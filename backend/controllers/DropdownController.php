<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\db\Expression;
use common\models\Hospital;

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
            $hospital = new Hospital();
           
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

}
