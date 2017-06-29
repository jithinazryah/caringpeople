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
