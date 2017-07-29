<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use common\models\StaffInfo;

class ReportController extends \yii\web\Controller {

        public function actionIndex() {
                return $this->render('index');
        }

        public function actionStaffs() {
                if (Yii::$app->request->isAjax) {
                        $branch = $_POST['branch'];
                        $staffs = StaffInfo::find()->where(['branch_id' => $branch, 'status' => 1, 'post_id' => 5])->all();
                        $options = '<option value="">-Select-</option>';
                        foreach ($staffs as $staffs) {
                                $options .= "<option value='" . $staffs->id . "'>" . $staffs->staff_name . "</option>";
                        }
                        echo $options;
                }
        }

}
