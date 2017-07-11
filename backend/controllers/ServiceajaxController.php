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
use common\models\ServiceSchedule;
use common\models\StaffInfo;
use yii\db\Expression;
use yii\data\Pagination;

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

        /*
         * update schedule
         */

        public function actionScheduleupdate() {
                if (Yii::$app->request->isAjax) {
                        if (isset($_POST['id'])) {
                                $service_schedule = ServiceSchedule::findOne($_POST['id']);
                                $service_schedule->remarks_from_manager = $_POST['remarks_from_manager'];
                                $service_schedule->remarks_from_staff = $_POST['remarks_from_staff'];
                                $service_schedule->remarks_from_patient = $_POST['remarks_from_patient'];
                                $service_schedule->status = $_POST['status'];
                                $service_schedule->attendance = $_POST['attendance'];
                                $service_schedule->update();
                        }
                }
        }

        /*
         * update schedule date
         */

        public function actionScheduledateupdate() {
                if (Yii::$app->request->isAjax) {
                        if (isset($_POST['id'])) {

                                $service_schedule = ServiceSchedule::findOne($_POST['id']);
                                if (isset($_POST['date']) && $_POST['date'] != '')
                                        $service_schedule->date = date('Y-m-d', strtotime($_POST['date']));

                                $service_schedule->update();
                        }
                }
        }

        /*
         * choose staff for schedule
         */

        public function actionChoosestaff() {
                $service_id = $_POST['service'];
                $staff = $this->renderPartial('_choose_staff', ['service_id' => $service_id]);
                echo $staff;
        }

        /*
         * search staff
         */

        public function actionSearchstaff() {
                if (Yii::$app->request->isAjax) {

                        $service_id = $_POST['service_id'];
                        $designation = $_POST['designation'];
                        $skills = $_POST['skills'];
                        $experience = $_POST['experience'];
                        $duty_staff = $_POST['include_onduty_staff'];



                        if (isset($experience) && $experience != '') {
                                $expfrom = $this->Experiencefrom($experience);
                                $expto = $this->Experienceto($experience);
                        }

                        /* ------------Query Builder-------------- */

                        $sql = '';
                        if (isset($designation) && $designation != '')
                                $sql .= " and (FIND_IN_SET('$designation', designation)) ";

                        if (isset($skills) && $skills != '')
                                $sql .= " and (FIND_IN_SET('$skills', staff_experience)) ";

                        if (isset($experience) && $experience != '')
                                $sql .= " and `years_of_experience` BETWEEN $expfrom AND $expto ";

                        if (isset($duty_staff) && $duty_staff == 'on')
                                $sql .= " and working_status=1 and working_status=0";
                        else
                                $sql .= " and working_status!=1";

                        $query = StaffInfo::find()->where("1=1 $sql");
                        $countQuery = clone $query;
                        $pages = new Pagination(['totalCount' => $countQuery->count()]);
                        $result = $query->offset($pages->offset)
                                ->limit($pages->limit)
                                ->all();


                        $search_result = $this->renderPartial('_search_reults', ['result' => $result, 'service_id' => $service_id, 'pages' => $pages,]);
                        echo $search_result;
                }
        }

        public function Experiencefrom($experience) {
                if ($experience == 5) {
                        $exp_from = 0;
                } else if ($experience == 10) {
                        $exp_from = 5;
                } else if ($experience == 10) {
                        $exp_from = 10;
                }
                return $exp_from;
        }

        public function Experienceto($experience) {
                if ($experience == 5) {
                        $exp_to = 5;
                } else if ($experience == 10) {
                        $exp_to = 10;
                } else if ($experience == 10) {
                        $exp_to = 15;
                }
                return $exp_to;
        }

        /* set selected staff for that service */

        public function actionSelectedstaff() {
                if (Yii::$app->request->isAjax) {
                        $staff = $_POST['staff'];
                        $service_id = $_POST['service_id'];
                        if (isset($service_id)) {
                                $schedules = ServiceSchedule::find()->where(['service_id' => $service_id, 'status' => 0])->all();
                                foreach ($schedules as $value) {
                                        $value->staff = $staff;
                                        $value->update();
                                }
                                $staff_status_update = StaffInfo::findOne($staff);
                                $staff_status_update->working_status = 1;
                                $staff_status_update->update();
                                echo $staff_status_update->staff_name;
                        }
                }
        }

        /* popup content for staff replacement */

        public function actionReplacestaffform() {
                $schedule_id = $_POST['schedule_id'];
                $staff = $this->renderPartial('_replace_staff', ['schedule_id' => $schedule_id]);
                echo $staff;
        }

        /* replace staff for a schedule */

        public function actionReplacestaff() {
                if (Yii::$app->request->isAjax) {
                        $schedule_id = $_POST['schedule_id'];
                        $choosed_staff = $_POST['staff'];

                        $schedule = ServiceSchedule::findOne($schedule_id);
                        $old_staff = $schedule->staff;
                        $schedule->staff = $choosed_staff;
                        $schedule->update();

                        $choosed_staff_status = StaffInfo::findOne($choosed_staff);
                        $choosed_staff_status->working_status = 1;
                        $choosed_staff_status->update();

                        $old_staff_exists = ServiceSchedule::find()->where(['staff' => $old_staff])->exists();
                        if ($old_staff_exists != '1') {
                                $old_staff_status = StaffInfo::findOne($old_staff);
                                $old_staff_status->working_status = 0;
                                $old_staff_status->update();
                        }

                        echo $choosed_staff_status->staff_name;
                }
        }

}
