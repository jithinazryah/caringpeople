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

class FollowupajaxController extends \yii\web\Controller {

        public function actionIndex() {
                return $this->render('index');
        }

        /*
         * This function is for delete followup
         *
         */

        public function actionDelete() {

                if (Yii::$app->request->isAjax) {
                        $val = $_POST['valu'];
                        $type = $_POST['type'];
                        $paths = Yii::getAlias(Yii::$app->params['uploadPath']) . '/followups/' . $val;
                        if (file_exists($paths)) {
                                $files = Yii::$app->UploadFile->RemoveFiles($paths);
                        }
                        if ($type == 'unset') {
                                Followups::findOne($val)->delete();
                        } else {
                                \common\models\RepeatedFollowups::findOne($val)->delete();
                        }
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
         * Add followup subtype in popup for adding followups
         */

        public function actionAddfollowups() {
                if (Yii::$app->request->isAjax) {
                        $datas = $this->renderPartial('form_for_popup', ['type' => $_POST['type'], 'type_id' => $_POST['type_id']]);
                        echo $datas;
                }
        }

        /*
         * Add followup to db on popup submit
         */

        public function actionAdd() {
                if (Yii::$app->request->isAjax) {

                        $followup = new Followups;
                        $followup->type = $_POST['type'];
                        $followup->type_id = $_POST['type_id'];
                        $followup->sub_type = $_POST['subtype'];
                        $followup->followup_date = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $_POST['followupdate'])));
                        $followup->assigned_from = Yii::$app->user->identity->id;
                        $followup->assigned_to = $_POST['assignedto'];
                        $followup->followup_notes = $_POST['notes'];
                        if (isset($_POST['related_staffs']) && $_POST['related_staffs'] != '')
                                $followup->related_staffs = implode(",", $_POST['related_staffs']);
                        $followup->CB = Yii::$app->user->identity->id;
                        $followup->DOC = date('Y-m-d');
                        $followup->save(false);
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
