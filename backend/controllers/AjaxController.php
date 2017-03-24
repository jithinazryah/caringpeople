<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Enquiry;

class AjaxController extends \yii\web\Controller {

        public function actionIndex() {
                return $this->render('index');
        }

        /*
         * This function select Countries based on the continent_id
         * return result to the view
         */

        public function actionState() {

                if (Yii::$app->request->isAjax) {
                        $country_id = $_POST['country_id'];
                        if ($country_id == '') {
                                echo '0';
                                exit;
                        } else {
                                $state_datas = \common\models\State::find()->where(['country_id' => $country_id])->all();
                                if (empty($state_datas)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $options = '<option value="">-Select State-</option>';
                                        foreach ($state_datas as $state_data) {
                                                $options .= "<option value='" . $state_data->id . "'>" . $state_data->state_name . "</option>";
                                        }
                                }
                        }

                        echo $options;
                }
        }

        /*
         * This function select City based on the district_id
         * return result to the view
         */

        public function actionCity() {
                if (Yii::$app->request->isAjax) {
                        $state_id = $_POST['state_id'];
                        if ($state_id == '') {
                                echo '0';
                                exit;
                        } else {
                                $city_datas = \common\models\City::find()->where(['state_id' => $state_id])->all();
                                if (empty($city_datas)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $options = '<option value="">-Select City-</option>';
                                        foreach ($city_datas as $city_data) {
                                                $options .= "<option value='" . $city_data->id . "'>" . $city_data->city_name . "</option>";
                                        }
                                }
                        }

                        echo $options;
                }
        }

        /*
         * This function select Caste based on the religion
         * return result to the view
         */

        public function actionReligion() {

                if (Yii::$app->request->isAjax) {
                        $religion = $_POST['religion'];
                        if ($religion == '') {
                                echo '0';
                                exit;
                        } else {
                                $caste_datas = \common\models\Caste::find()->where(['r_id' => $religion])->all();
                                if (empty($caste_datas)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $options = '<option value="">-Select-</option>';
                                        foreach ($caste_datas as $caste_data) {
                                                $options .= "<option value='" . $caste_data->id . "'>" . $caste_data->caste . "</option>";
                                        }
                                }
                        }

                        echo $options;
                }
        }

        public function actionEmail() {
                if (Yii::$app->request->isAjax) {
                        $email = $_POST['email'];
                        $exists = Enquiry::find()->where(['email' => $email])->exists();
                        if ($exists == 1) {
                                $user = Enquiry::find()->where(['email' => $email])->all();
                                if (count($user) > 1) {
                                        return 1;
                                } else {
                                        foreach ($user as $value) {
                                                return $value->id;
                                        }
                                }
                        } else {
                                return $data = 0;
                        }
                }
        }

}
