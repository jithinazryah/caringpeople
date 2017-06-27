<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use common\models\RepeatedFollowups;
use common\models\Followups;
use common\models\FollowupType;
use common\models\Hospital;
use common\models\FollowupSubType;
use common\models\StaffInfo;
use kartik\datetime\DateTimePicker;
use yii\web\UploadedFile;

class FollowupajaxController extends \yii\web\Controller {

        public function actionIndex() {
                return $this->render('index');
        }

        public function actionAddfollowup() {
                if (Yii::$app->request->isAjax) {

                        $followups = new \common\models\RepeatedFollowups();
                        if (isset($_POST['RepeatedFollowups']['related_staffs']) && $_POST['RepeatedFollowups']['related_staffs'] != '')
                                $followups->related_staffs = implode(',', $_POST['RepeatedFollowups']['related_staffs']);

                        if ($followups->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($followups) && $followups->validate()) {

                                $file = UploadedFile::getInstance($followups, 'attachments');

                                if ($followups->repeated == 0) {
                                        $followups_one = new Followups();
                                        $this->Adddata($followups_one, $followups);
                                        $followups_one->save(false);
                                        $this->upload($followups_one, $file, $followups_one->id, 1);
                                        $content = $this->Showdata($followups_one);
                                } else {
                                        if ($followups->repeated_type != 1) {
                                                if ($_POST['create']['specific-days'] != '' || $_POST['create']['specific-dates-month'] != '') {
                                                        if ($followups->repeated_type == 2) {
                                                                $followups->repeated_days = implode(',', $_POST['create']['specific-days']);
                                                        } else if ($followups->repeated_type == 3) {
                                                                $followups->repeated_days = implode(',', $_POST['create']['specific-dates-month']);
                                                        }
                                                        $followups->save(false);
                                                        $this->upload($followups, $file, $followups->id, 2);
                                                }
                                        } else {
                                                foreach ($_POST['date']['remind_days1'] as $val) {
                                                        if ($val != '') {
                                                                $followups_add = new Followups();
                                                                $this->Adddata($followups_add, $followups);
                                                                $followups_add->followup_date = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $val)));
                                                                $followups_add->save(false);
                                                                $this->upload($followups_add, $file, $followups_add->id, 1);
                                                        }
                                                }
                                        }
                                }
                                if (!empty($content)) {
                                        $data['result'] = $content;
                                        echo json_encode($data);
                                }
                        }
                }
        }

        public function Adddata($followups_one, $followups) {
                $followups_one->type = $followups->type;
                $followups_one->type_id = $followups->type_id;
                $followups_one->followup_date = date('Y-m-d H:i:s', strtotime($_POST['Followups']['followup_date']));
                $followups_one->followup_notes = $followups->followup_notes;
                $followups_one->assigned_to = $followups->assigned_to;
                $followups_one->assigned_from = Yii::$app->user->identity->id;
                if (isset($_POST['RepeatedFollowups']['related_staffs']) && $_POST['RepeatedFollowups']['related_staffs'] != '')
                        $followups_one->related_staffs = implode(',', $_POST['RepeatedFollowups']['related_staffs']);
        }

        public function Showdata($followup) {

                $followup = Followups::findOne($followup->id);
                $count = Followups::find()->where(['type' => $followup->type, 'type_id' => $followup->type_id, 'status' => 0])->count();
                $subtype = FollowupSubType::findOne($followup->sub_type);
                $assigned_to = StaffInfo::findOne($followup->assigned_to);
                $assigned_from = StaffInfo::findOne($followup->assigned_from);
                if (isset($followup->related_staffs) && $followup > related_staffs != '') {
                        $related_staffs = explode(',', $followup->related_staffs);
                        $relatedstaffs = '';
                        $i = 0;
                        if (!empty($related_staffs)) {
                                foreach ($related_staffs as $related) {
                                        if ($i != 0) {
                                                $relatedstaffs .= ',';
                                        }
                                        $staff_name = StaffInfo::findOne($related);
                                        $relatedstaffs .= $staff_name->staff_name;
                                        $i++;
                                }
                        }
                }
                $arr_variable = array($count + 1, $subtype->sub_type, $followup->followup_date, $followup->followup_notes, $assigned_to->staff_name, $assigned_from->staff_name, $relatedstaffs, $followup->id);
                return $arr_variable;
        }

        public function Upload($model, $image, $id, $type) {
                if (isset($image->name) && $image->name != '') {
                        if ($type == '1')
                                $paths = ['followups', $id];
                        else
                                $paths = ['followups', 'repeated', $id];

                        $paths = Yii::$app->UploadFile->CheckPath($paths);
                        $image->saveAs($paths . '/' . $image->name . '.' . $image->extension);
                }
        }

        /*
         * This function is for update followup status
         *
         */

        public function actionFollowupstatus() {

                if (Yii::$app->request->isAjax) {
                        // $followup_id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $_POST['followup_id']);
                        $type = $_POST['type'];
                        $followup_id = $_POST['followup_id'];
                        if ($type == '1')
                                $followup = Followups::find()->where(['id' => $followup_id])->one();
                        else
                                $followup = \common\models\RepeatedFollowups::find()->where(['id' => $followup_id])->one();
                        $followup->status = 1;
                        $followup->update();
                }
        }

        /*
         * show followup subtype on followup type change in add followup form
         */

        public function actionSubtype() {

                if (Yii::$app->request->isAjax) {

                        $type = $_POST['type'];
                        if ($type == '') {
                                $options = '<option value="">--Select--</option>';
                        } else {

                                //   if ($type != 5) {

                                $state_datas = \common\models\FollowupSubType::find()->where(['type_id' => $type])->all();
                                $options = '<option value="">--Select--</option>';
                                foreach ($state_datas as $state_data) {
                                        $options .= "<option value='" . $state_data->id . "'>" . $state_data->sub_type . "</option>";
                                }
//                                } else {
//                                        $state_datas = \common\models\Service::find()->where(['status' => 1])->all();
//                                        $options = '<option value="">--Select--</option>';
//                                        foreach ($state_datas as $state_data) {
//                                                $options .= "<option value='" . $state_data->id . "'>" . $state_data->id . "</option>";
//                                        }
//                                        $options .= "<option value=common> Common </option>";
//                                }
                        }

                        echo $options;
                }
        }

        /*
         * to remove images of followups (uploaded images in followups)
         */

        public function actionAttachremove() {

                $id = $_POST['id'];
                $name = $_POST['name'];

                $root_path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/followups';
                $path = $root_path . '/' . $id . '/' . $name;

                if (file_exists($path)) {

                        if (unlink($path)) {

                                $data_update = Followups::find()->where(['id' => $id])->one();
                                $data_update->attachments = '';
                                $data_update->update();
                        }
                }
        }

}
