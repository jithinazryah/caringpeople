<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use common\models\Enquiry;
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



                        $repeated = $_POST['RepeatedFollowups']['repeated'];
                        if ($repeated == 0) {
                                $followups = new Followups();
                                $this->Adddata($followups);
                                $followups->save(false);
                        } else {
                                if ($_POST['RepeatedFollowups']['repeated_type'] != 1) {
                                        $followups = new \common\models\RepeatedFollowups();
                                        $this->Adddata($followups);
                                        $followups->repeated_type = $_POST['RepeatedFollowups']['repeated_type'];
                                        if ($_POST['create']['specific-days'] != '' || $_POST['create']['specific-dates-month'] != '') {
                                                if ($followups->repeated_type == 2) {
                                                        $followups->repeated_days = implode(',', $_POST['create']['specific-days']);
                                                } else if ($followups->repeated_type == 3) {
                                                        $followups->repeated_days = implode(',', $_POST['create']['specific-dates-month']);
                                                }
                                                $followups->save(false);
                                        }
                                } else {
                                        foreach ($_POST['date']['remind_days1'] as $val) {
                                                if ($val != '') {
                                                        $followups_add = new Followups();
                                                        $this->Adddata($followups_add);
                                                        $followups_add->followup_date = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $val)));
                                                        $followups_add->save(false);
                                                }
                                        }
                                }
                        }
                }
        }

        public function Adddata($followups) {

                $followups->type = $_POST['RepeatedFollowups']['type'];
                $followups->type_id = $_POST['RepeatedFollowups']['type_id'];
                $followups->followup_date = date('Y-m-d H:i:s', strtotime($_POST['Followups']['followup_date']));
                $followups->followup_notes = $_POST['RepeatedFollowups']['followup_notes'];
                $followups->assigned_to = $_POST['RepeatedFollowups']['assigned_to'];
                $followups->assigned_from = Yii::$app->user->identity->id;
                if (isset($_POST['RepeatedFollowups']['related_staffs']) && $_POST['RepeatedFollowups']['related_staffs'] != '')
                        $followups->related_staffs = $_POST['RepeatedFollowups']['related_staffs'];
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
