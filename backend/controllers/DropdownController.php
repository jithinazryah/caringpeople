<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\db\Expression;
use common\models\Hospital;
use common\models\Remarks;

class DropdownController extends \yii\web\Controller {

        public function actionIndex() {
                return $this->render('index');
        }

        public function actionShowform() {
                $type = $_POST['type'];

                if ($type == '1') { /* add hospital */
                        $form = $this->renderPartial('_hospital', ['type' => $type, 'field_id' => $_POST['field_id']]);
                } else if ($type == 2) { /* add remarks category */
                        $form = $this->renderPartial('_remark_category', ['type' => $type, 'field_id' => $_POST['field_id'], 'cat_type' => $_POST['cat_type']]);
                } else if ($type == 3) { /* add followups category */
                        $form = $this->renderPartial('_followup_category', ['type' => $type, 'field_id' => $_POST['field_id'], 'cat_type' => $_POST['cat_type']]);
                } else if ($type == 4) { /* add staff skills */
                        $form = $this->renderPartial('_skills', ['type' => $type, 'field_id' => $_POST['field_id']]);
                }

                echo $form;
        }

        public function actionAdd() {

                if (Yii::$app->request->isAjax) {
                        $type = $_POST['type'];
                        if ($type == 1) {
                                $model = new Hospital();
                        } else if ($type == 2) {
                                $model = new \common\models\RemarksCategory();
                        } else if ($type == 3) {
                                $model = new \common\models\FollowupSubType();
                        } else if ($type == 4) {
                                $model = new \common\models\StaffExperienceList();
                        }
                        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
                                $model->status = 1;
                                if ($model->save(false)) {

                                        if ($type == 1) {
                                                $arr_variable = array('id' => $model->id, 'name' => $model->hospital_name, 'field_id' => $_POST['field_id'], 'type' => '1');
                                        }
                                        if ($type == 2) {
                                                $arr_variable = array('id' => $model->id, 'name' => $model->category, 'field_id' => $_POST['field_id'], 'type' => '1');
                                        }
                                        if ($type == 3) {
                                                $arr_variable = array('id' => $model->id, 'name' => $model->sub_type, 'field_id' => $_POST['field_id'], 'type' => '1');
                                        }
                                        if ($type == 4) {
                                                $arr_variable = array('id' => $model->id, 'name' => $model->title, 'field_id' => $_POST['field_id'], 'type' => '2');
                                        }
                                        $data['result'] = $arr_variable;
                                        echo json_encode($data);
                                }
                        }
                }
        }

        public function actionAddremarks() {

                if (Yii::$app->request->isAjax) {
                        $remarks = new Remarks();
                        $remarks->status = 1;

                        if ($remarks->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($remarks) && $remarks->validate()) {
                                $remarks->date = date('Y-m-d', strtotime($remarks->date));
                                $remarks->save();
                                if ($remarks->type == '2' || $remarks->type == '4')
                                        $pp = $this->Rating($remarks->type_id, $remarks->type);

                                $count = Remarks::find()->where(['type' => $remarks->type, 'type_id' => $remarks->type_id, 'status' => 1])->count();
                                $category = \common\models\RemarksCategory::findOne($remarks->category);

                                $remarks->category = $category->category;
                                $remarks->UB = $count;
                                return \yii\helpers\Json::encode($remarks);
                        }
                }
        }

        public function actionChangeremarkstatus() {
                $remark = Remarks::findOne($_POST['remark_id']);
                $remark->status = 2;
                if ($remark->update()) {
                        echo '1';
                } else {
                        echo '0';
                }
        }

        public function Rating($id, $type) {

                if ($type == '4') {
                        $person = \common\models\StaffInfo::findOne($id);
                }
                if ($type == '2') {
                        $person = \common\models\PatientGeneral::findOne($id);
                }
                $total_remarks_point = Remarks::find()->where(['type_id' => $id])->sum('point');
                $total_remarks = Remarks::find()->where(['type_id' => $id])->count();
                $rating = $total_remarks_point / $total_remarks * 9;
                $person->average_point = $rating;
                $person->save();
        }

}
