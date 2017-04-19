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
use common\models\AdminUsers;

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
                        Followups::findOne($val)->delete();
                }
        }

        /*
         * This function is for update followup status
         *
         */

        public function actionFollowupstatus() {

                if (Yii::$app->request->isAjax) {
                        // $followup_id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $_POST['followup_id']);
                        $followup_id = $_POST['followup_id'];
                        $followup = Followups::find()->where(['id' => $followup_id])->one();
                        $followup->status = 1;
                        $followup->update();
                }
        }

        /*
         * This function is for adding multiple followup details
         */

        public function actionFollowups() {
                if (Yii::$app->request->isAjax) {

                        $followup_type = FollowupType::find()->all();
                        $type = Html::dropDownList('create[typed][]', null, ArrayHelper::map($followup_type, 'id', 'type'), ['class' => 'form-control followup_type', 'prompt' => '--Select--',]);

                        $followup_subtype = FollowupSubType::find()->where(['type_id' => $_POST['type'], 'status' => '1'])->all();

                        if ($_POST['type'] == 'NULL') {
                                $followtype = "<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                              <div class='form-group field-followups-sub_type'>
                                                 <label class='control-label'> Type</label>
                                                 $type
                                              </div>
                                          </div>";
                        } else {
                                $followtype = '';
                        }

                        $options = Html::dropDownList('create[sub_type][]', null, ArrayHelper::map($followup_subtype, 'id', 'sub_type'), ['class' => 'form-control followup_subtype', 'prompt' => '--Select--', 'required' => "required"]);

                        $all_users = AdminUsers::find()->where(['post_id' => '5'])->andWhere(['<>', 'id', Yii::$app->user->identity->id])->all();
                        $assigned_to = Html::dropDownList('create[assigned_to][]', null, ArrayHelper::map($all_users, 'id', 'name'), ['class' => 'form-control', 'prompt' => '--Select--', 'required' => "required"]);

                        $userid = Yii::$app->user->identity->id;
                        $user = AdminUsers::findOne($userid);



                        $datas = "<span>
                                <hr style='border-top: 1px solid #979898 !important;'>
                                <input type='hidden' name='create[type][]' value='" . $_POST['type'] . "'>
                                <input type='hidden' name='create[type_id][]' value='" . $_POST['type_id'] . "'>
                                        $followtype
                                          <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                              <div class='form-group field-followups-sub_type'>
                                                 <label class='control-label'>Sub Type</label>
                                                 $options
                                              </div>
                                          </div>

                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                            <div class='form-group field-followups-followup_date'>
                                               <label class='control-label followup_date' for='followups-followup_date'>Followup Date</label>
                                                 <input type='datetime-local' class='form-control some_class' name='create[followup_date][]' data-mask='datetime'>
                                            </div>
                                        </div>

                                         <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                              <div class='form-group field-followups-assigned_to'>
                                                 <label class='control-label'>Assigned To</label>
                                                 $assigned_to
                                              </div>
                                          </div>

                                         <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                            <div class='form-group field-followups-followup_notes'>
                                               <label class='control-label' for='followups-followup_notes'>Followup Notes</label>
                                                 <textarea class='form-control' name='create[followup_notes][]'></textarea>
                                            </div>
                                        </div>

                                          <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                            <div class='form-group field-followups-assigned_from'>
                                               <label class='control-label' for='followups-assigned_from'>Assigned From</label>
                                                 <input type='text' class='form-control' name='create[assigned_from][]' value='.$user->name' readonly='readonly'>
                                            </div>
                                        </div>

                                          <a id='remFollowup' class='btn btn-icon btn-red remFollowup' title='Delete' style='margin-top: 15px;'><i class='fa-remove'></i></a>
                                          <div style='clear:both'></div>


                                  </span>";
                        echo $datas;
                }
        }

        public function actionAddfollowups() {
                if (Yii::$app->request->isAjax) {
                        $followup_subtype = FollowupSubType::find()->where(['type_id' => $_POST['type'], 'status' => '1'])->all();
                        $options = Html::dropDownList('sub_type', null, ArrayHelper::map($followup_subtype, 'id', 'sub_type'), ['class' => 'form-control subtypediv', 'id' => 'field-1', 'prompt' => '--Select--', 'required' => 'required']);
                        $datas = "<div class='subtypediv'><label for='field-1' class='control-label subtypediv'>Sub Type</label>
                                 $options</div>";
                        echo $datas;
                }
        }

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
                        $followup->CB = Yii::$app->user->identity->id;
                        $followup->DOC = date('Y-m-d');
                        $followup->save(false);
                }
        }

        public function actionSubtype() {

                if (Yii::$app->request->isAjax) {

                        $type = $_POST['type'];
                        if ($type == '') {
                                echo '0';
                                exit;
                        } else {
                                $state_datas = \common\models\FollowupSubType::find()->where(['type_id' => $type])->all();
                                if (empty($state_datas)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $options = '<option value="">--Select--</option>';
                                        foreach ($state_datas as $state_data) {
                                                $options .= "<option value='" . $state_data->id . "'>" . $state_data->sub_type . "</option>";
                                        }
                                }
                        }

                        echo $options;
                }
        }

}
