<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\UploadedFile;
use common\models\RateCard;

class ServiceajaxController extends \yii\web\Controller {

        public function actionIndex() {
                return $this->render('index');
        }

        /*
         * Show services in rate card
         */

        public function actionServices() {
                $services = RateCard::find()->where(['branch_id' => $_POST['branch']])->all();
                $added_services = [];
                foreach ($services as $value) {
                        $added_services[] = $value->service_id;
                }
                $service = \common\models\MasterServiceTypes::find()->where(['not in', 'id', $added_services])->andWhere(['status' => 1])->orderBy(['service_name' => SORT_ASC])->all();
                $service_options = "<option>--Select--</option>";
                foreach ($service as $service) {
                        $service_options .= "<option value='" . $service->id . "'>" . $service->service_name . "</option>";
                }
                echo $service_options;
        }

        /*
         * show service duty type values based on ratecard values
         */

        public function actionDutytype() {
                $branch = $_POST['branch'];
                $service = $_POST['service'];
                if (isset($branch) && $branch != '') {
                        $rates = RateCard::find()->where(['service_id' => $service, 'branch_id' => $branch, 'status' => 1])->one();
                        if (!empty($rates)) {
                                $options = '<option value="">-Select-</option>';
                                $i = 0;
                                if (isset($rates->rate_per_hour) && $rates->rate_per_hour != '') {
                                        $options .= "<option value='1'>Hourly</option>";
                                        $i++;
                                } if (isset($rates->rate_per_visit) && $rates->rate_per_visit != '') {
                                        $options .= "<option value='2'>Visit</option>";
                                        $i++;
                                } if (isset($rates->rate_per_day) && $rates->rate_per_day != '') {
                                        $options .= "<option value='3'>Day</option>";
                                        $i++;
                                } if (isset($rates->rate_per_night) && $rates->rate_per_night != '') {
                                        $options .= "<option value='4'>Night</option>";
                                        $i++;
                                } if (isset($rates->rate_per_day_night) && $rates->rate_per_day_night != '') {
                                        $options .= "<option value='5'>Day & Night</option>";
                                        $i++;
                                }

                                if ($i == 0) {
                                        echo '3';
                                } else {
                                        echo $options;
                                }
                        } else {
                                echo '2';
                        }
                } else {
                        echo '1';
                }
        }

        /*
         * calculate estimated price
         */

        public function actionEstimatedprice() {

                if (Yii::$app->request->isAjax) {

                        $price = 0;
                        $frequency = $_POST['frequency'];
                        $duty_type = $_POST['duty_Type'];
                        $hours = $_POST['hours'];
                        $days = $_POST['days'];
                        $ratecard = RateCard::find()->where(['service_id' => $_POST['service'], 'branch_id' => $_POST['branch'], 'status' => 1])->one();

                        if ($duty_type == 1) {
                                $type = 'rate_per_hour';
                        } else if ($duty_type == 2) {
                                $type = 'rate_per_visit';
                        } else if ($duty_type == 3) {
                                $type = 'rate_per_day';
                        } else if ($duty_type == 4) {
                                $type = 'rate_per_night';
                        } else if ($duty_type == 5) {
                                $type = 'rate_per_day_night';
                        }
                        /*
                         * if frequency == daily snd duty type= day or night
                         */
                        if ($frequency == 1 && $duty_type == 3 || $duty_type == 4) {
                                if (isset($ratecard->$type)) {
                                        $price = $days * $ratecard->$type;
                                }
                        } else {
                                $total_hours = $hours * $days;
                                if (isset($ratecard->$type)) {
                                        $price = $total_hours * $ratecard->$type;
                                }
                        }

                        echo $price;
                }
        }

        /*
         * calculate to datee
         */

        public function actionTodate() {
                if (Yii::$app->request->isAjax) {
                        $frequency = $_POST['frequency'];
                        $days = $_POST['days'];
                        $from = $_POST['from'];
                        $from = date('Y-m-d', strtotime($from));
                        if ($frequency == '1') {
                                echo date('d-m-Y', strtotime($from . ' + ' . $days . ' days'));
                        } else if ($frequency == '2') {
                                echo date('d-m-Y', strtotime($from . ' + ' . $days . ' weeks'));
                        } else if ($frequency == '3') {
                                echo date('d-m-Y', strtotime($from . ' + ' . $days . ' months'));
                        }
                }
        }

}
