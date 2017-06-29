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

        public function actionAddhospital() {

                $hospital = $this->renderPartial('_hospital');

                echo $hospital;
        }

        public function actionAdd() {

                if (Yii::$app->request->isAjax) {
                        $model = new Hospital();

                        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {

                        }

                        //$hospital->hospital_name=$_POST['hospital_name'];
//            $hospital->contact_person=$_POST['contact_person'];
//            $hospital->contact_email=$_POST['contact_email'];
//            $hospital->contact_number=$_POST['contact_number'];
//            $hospital->contact_number_2=$_POST['contact_number_2'];
//            $hospital->address=$_POST['address'];
//            var_dump($hospital);exit;
//            Yii::$app->SetValues->Attributes($model);
//            if ($model->save(false)) {
//                $arrr_variable = array('hospital-id' => $model->id, 'hospital-name' => $model->hospital_name);
//                $data['result'] = $arrr_variable;
//                echo json_encode($data);
//            }
                }
        }

        public function actionAddremarks() {

                if (Yii::$app->request->isAjax) {
                        $remarks = new Remarks();
                        $remarks->status = 1;

                        if ($remarks->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($remarks) && $remarks->validate()) {
                                $remarks->date = date('Y-m-d', strtotime($remarks->date));
                                $remarks->save();
                                $count = Remarks::find()->where(['type' => $remarks->type, 'type_id' => $remarks->type_id, 'status' => 1])->count();
                                $category = \common\models\RemarksCategory::findOne($remarks->category);
                                $arr_variable = array($count, $category->category, $remarks->sub_category, $remarks->point, $remarks->notes, $remarks->date, $remarks->id);
                                $data['result'] = $arr_variable;
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

}
