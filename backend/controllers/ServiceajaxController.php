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
use common\components\SetValues;
use common\models\Service;

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
                $service_options = "<option value='0'>--Select--</option>";
                foreach ($service as $service) {
                        $service_options .= "<option value='" . $service->id . "'>" . $service->service_name . "</option>";
                }
                echo $service_options;
        }

        /*
         * show subservices in ratecard
         */

        public function actionSubservices() {

                $sub_serv = \common\models\SubServices::find()->where(['branch_id' => $_POST['branch']])->orWhere(['branch_id' => 0])->andWhere(['service' => $_POST['service']])->all();

                $subservice_options = "<option value='0'>--Select--</option>";
                foreach ($sub_serv as $service) {
                        $subservice_options .= "<option value='" . $service->id . "'>" . $service->sub_service . "</option>";
                }
                echo $subservice_options;
        }

        /*
         * for checking if already rate card is added to this service/subservice
         */

        public function actionCheckratecard() {
                $branch = $_POST['branch'];
                $service = $_POST['service'];
                $sub_service = $_POST['sub_service'];
                if (isset($sub_service) && $sub_service != '' && $sub_service != 0) {
                        $exists = RateCard::find()->where(['service_id' => $service, 'sub_service' => $sub_service, 'branch_id' => $branch])->exists();
                } else {
                        $exists = RateCard::find()->where(['service_id' => $service, 'sub_service' => $sub_service, 'branch_id' => $branch])->exists();
                }
                echo $exists;
        }

        /*
         * show service duty type values based on ratecard values of service
         */

        public function actionDutytype() {
                $branch = $_POST['branch'];
                $service = $_POST['service'];
                if (isset($branch) && $branch != '') {
                        $rates = RateCard::find()->where(['service_id' => $service, 'branch_id' => $branch, 'status' => 1, 'sub_service' => 0])->one();

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
         * show service duty type values based on ratecard values of subservice
         */

        public function actionSubdutytype() {
                $branch = $_POST['branch'];
                $service = $_POST['service'];
                $sub_service = $_POST['sub_service'];
                if (isset($branch) && $branch != '') {
                        $rates = RateCard::find()->where(['service_id' => $service, 'branch_id' => $branch, 'status' => 1, 'sub_service' => $sub_service])->one();
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
                        $sub_service = $_POST['sub_service'];
                        if ($sub_service == '')
                                $sub_service = 0;
                        $ratecard = RateCard::find()->where(['service_id' => $_POST['service'], 'branch_id' => $_POST['branch'], 'status' => 1, 'sub_service' => $sub_service])->one();

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

                        if ($frequency == 1 && ($duty_type == 3 || $duty_type == 4 || $duty_type == 5)) {
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
                                $dates = date('d-m-Y', strtotime($from . ' + ' . $days . ' days'));
                                echo date('d-m-Y', strtotime($dates . ' -1 days'));
                        } else if ($frequency == '2') {
                                $dates = date('d-m-Y', strtotime($from . ' + ' . $days . ' weeks'));
                                echo date('d-m-Y', strtotime($dates . ' -1 days'));
                        } else if ($frequency == '3') {
                                $dates = date('d-m-Y', strtotime($from . ' + ' . $days . ' months'));
                                echo date('d-m-Y', strtotime($dates . ' -1 days'));
                        }
                }
        }

        public function actionServicestatus() {
                if (Yii::$app->request->isAjax) {
                        $service_id = $_POST['service_id'];
                        if (isset($service_id)) {
                                $scheduls_exists = ServiceSchedule::find()->where(['status' => 1, 'service_id' => $service_id])->count();
                                if ($scheduls_exists == 0) {
                                        $service = Service::findOne($service_id);
                                        $service->status = 2;
                                        if ($service->update())
                                                echo'1';
                                } else {
                                        echo '2';
                                }
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
         * add rating
         */

        public function actionAddrating() {
                if (Yii::$app->request->isAjax) {
                        $schedule_id = $_POST['schedule_id'];
                        $schedule_staff = ServiceSchedule::findOne($schedule_id);
                        $staff = $schedule_staff->staff;
                        if (isset($staff) && $staff != '') {
                                $schedule_staff->rating = $_POST['rating'];
                                $schedule_staff->update();
                                $rates = SetValues::Rating($staff, '');
                        }
                }
        }

        /*
         * update schedule status and rate
         */

        public function actionStatusupdate() {
                if (Yii::$app->request->isAjax) {
                        $schedule_id = $_POST['schedule_id'];
                        $status = $_POST['status'];
                        $schedule = ServiceSchedule::findOne($schedule_id);
                        $rate = $this->renderPartial('_daily_rate', ['schedule_id' => $schedule->id, 'status' => $status]);
                        echo $rate;
                }
        }

        /*
         * Add rate of staff of each schedule
         */

        public function actionAddrate() {
                if (Yii::$app->request->isAjax) {
                        $schedule_id = $_POST['scheduleid'];
                        $status = $_POST['status'];
                        $schedule_detail = ServiceSchedule::findOne($schedule_id);
                        $service_detail = Service::findOne($schedule_detail->service_id);
                        if (!empty($schedule_detail) && isset($status)) {
                                $schedule_detail->remarks_from_staff = $_POST['remarks_staff'];
                                $schedule_detail->remarks_from_manager = $_POST['remarks_manager'];
                                $schedule_detail->rate = $_POST['rate'];
                                $schedule_detail->patient_rate = $_POST['rate_patient'];
                                $schedule_detail->time_in = $_POST['time_in'];
                                $schedule_detail->time_out = $_POST['time_out'];
                                $schedule_detail->status = $status;
                                $schedule_detail->update();

                                if (isset($schedule_detail->staff) && $schedule_detail->staff != '') {
                                        if ($status == 2 || $status == 4) { /* if status completed or cancelled */
                                                $taff_exists = ServiceSchedule::find()->where(['staff' => $schedule_detail->staff, 'status' => 1])->exists();
                                                if ($taff_exists != '1') {
                                                        $this->StaffStatus($schedule_detail->staff, 0);
                                                        $service_detail->service_staffs = $this->Servicestaffs($schedule_detail->service_id);
                                                        $service_detail->update(FALSE);
                                                }
                                        }
                                        if ($status == 3 || $status == 4) { /* status is interupted or cancelled */
                                                $service_detail->estimated_price = $this->ChangePrice($service_detail, 1, 2);
                                                $service_detail->estimated_price;
                                                $service_detail->update(FALSE);
                                        }
                                }
                        }
                }
        }

        /* set selected staff for that service */

        public function actionSelectedstaff() {
                if (Yii::$app->request->isAjax) {
                        $type = $_POST['type'];
                        $staff = $_POST['staff'];
                        if ($type == 1) {
                                $service_id = $_POST['service_id'];
                                if (isset($service_id)) {
                                        $schedules = ServiceSchedule::find()->where(['service_id' => $service_id])->andWhere(['status' => 1])->all();
                                        foreach ($schedules as $value) {
                                                if (isset($value->staff) && $value->staff != '')
                                                        $this->StaffStatus($value->staff, 0);
                                                $value->staff = $staff;
                                                $value->update();
                                        }
                                        $this->StaffStatus($staff, 1);
                                        $service_detail = Service::findOne($service_id);
                                        $service_detail->service_staffs = $this->Servicestaffs($service_id);
                                        $service_detail->update(FALSE);
                                }
                        } else {
                                $schedule_id = $_POST['schedule_id'];
                                $schedule = ServiceSchedule::findOne($schedule_id);
                                $old_staff = $schedule->staff;
                                $schedule->staff = $staff;
                                $schedule->update();
                                $this->StaffStatus($staff, 1);
                                $service_detail = Service::findOne($schedule->service_id);
                                $service_detail->service_staffs = $this->Servicestaffs($schedule->service_id);
                                $service_detail->update(FALSE);

                                $old_staff_exists = ServiceSchedule::find()->where(['staff' => $old_staff])->exists();
                                if ($old_staff_exists != '1') {
                                        $this->StaffStatus($old_staff, 0);
                                }
                        }
                }
        }

        public function StaffStatus($id, $status) {
                $staff_status_update = StaffInfo::findOne($id);
                if (!empty($staff_status_update)) {
                        $staff_status_update->working_status = $status;
                        $staff_status_update->update();
                }
        }

        /*
         * add more schedules popup
         */

        public function actionSchedule() {
                $service_id = $_POST['service_id'];
                $service = Service::findOne($service_id);
                $schedule = $this->renderPartial('add_schedule', ['service' => $service]);
                echo $schedule;
        }

        /*
         * add schedule
         */

        public function actionAddschedule() {

                if (Yii::$app->request->isAjax) {
                        $service_id = $_POST['service_id'];
                        $patient_id = $_POST['patient_id'];
                        $add_days = $_POST['no_of_days'];
                        $duty_type = $_POST['duty_type'];
                        $frequency = $_POST['frequency'];
                        $hours = $_POST['hours'];
                        $days = $_POST['days'];
                        if (($duty_type == 5 || $duty_type == 3 || $duty_type == 4 ) && $frequency == 1) {
                                $schedule_count = $add_days;
                        } else if ($duty_type == 1) {
                                $schedule_count = $add_days;
                        } else {
                                $schedule_count = $hours * $add_days;
                        }
                        $service = Service::findOne($service_id);

                        if ($duty_type == 5) {
                                if ($service->day_night_staff == 2) {

                                        for ($x = 1; $x <= $schedule_count; $x++) {
                                                $day_schedule = new ServiceSchedule();
                                                $night_schedule = new ServiceSchedule();
                                                $day_schedule->service_id = $service_id;
                                                $day_schedule->patient_id = $patient_id;
                                                $day_schedule->status = 1;
                                                $day_schedule->rate = 0;
                                                $night_schedule->service_id = $service_id;
                                                $night_schedule->patient_id = $patient_id;
                                                $night_schedule->status = 1;
                                                $night_schedule->rate = 0;
                                                $night_schedule->save(false);
                                                $day_schedule->save(false);
                                        }
                                } else {

                                        for ($x = 1; $x <= $schedule_count; $x++) {
                                                $day_schedule = new ServiceSchedule();
                                                $day_schedule->service_id = $service_id;
                                                $day_schedule->patient_id = $patient_id;
                                                $day_schedule->status = 1;
                                                $day_schedule->rate = 0;
                                                $day_schedule->save(false);
                                        }
                                }
                        } else {
                                for ($x = 1; $x <= $schedule_count; $x++) {
                                        $schedule = new ServiceSchedule();
                                        $schedule->service_id = $service_id;
                                        $schedule->patient_id = $patient_id;
                                        $schedule->status = 1;
                                        $schedule->rate = 0;
                                        $schedule->save(false);
                                }
                        }

                        $service = Service::findOne($service_id);
                        $service->days = $service->days + $add_days;
                        if ($frequency == '1') {
                                $todate = date('Y-m-d', strtotime($service->from_date . ' + ' . $service->days . ' days'));
                                $service->to_date = date('Y-m-d', strtotime($todate . ' - 1 days'));
                        } else if ($frequency == '2') {
                                $todate = date('Y-m-d', strtotime($service->from_date . ' + ' . $service->days . ' weeks'));
                                $service->to_date = date('Y-m-d', strtotime($todate . ' - 1 days'));
                        } else if ($frequency == '3') {
                                $todate = date('Y-m-d', strtotime($service->from_date . ' + ' . $service->days . ' months'));
                                $service->to_date = date('Y-m-d', strtotime($todate . ' - 1 days'));
                        }
                        $service->estimated_price = $this->ChangePrice($service, $add_days, 1);
                        $service->save(FALSE);
                }
        }

        public function Calculateprice($service_id, $branch_id, $duty_type, $frequency, $hours, $days, $sub_service) {
                $price = 0;

                $ratecard = RateCard::find()->where(['service_id' => $service_id, 'branch_id' => $branch_id, 'status' => 1, 'sub_service' => $sub_service])->one();

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
                if ($frequency == 1 && ($duty_type == 3 || $duty_type == 4 || $duty_type == 5)) {
                        if (isset($ratecard->$type)) {
                                $price = $days * $ratecard->$type;
                        }
                } else {
                        $total_hours = $hours * $days;
                        if (isset($ratecard->$type)) {
                                $price = $total_hours * $ratecard->$type;
                        }
                }

                return $price;
        }

        /*
         * who can view this service ->assign that list
         */

        public function Servicestaffs($service) {
                $schedules = ServiceSchedule::find()->where(['service_id' => $service])->andWhere(['<>', 'status', '2'])->all();
                $i = 0;
                $id = '';
                foreach ($schedules as $value) {

                        if (isset($value->staff)) {
                                if (!preg_match('/\b' . $value->staff . '\b/', $id)) {
                                        if ($i != 0) {
                                                $id .= ',';
                                        }
                                        $id .= $value->staff;
                                }
                        }

                        $i++;
                }
                $id .= ',';
                $service_details = Service::findOne($service);
                $id .= $service_details->CB . ',';
                if (isset($service_details->staff_manager))
                        $id .= $service_details->staff_manager;

                return $id;
        }

        /* calculate estimated price */

        public function ChangePrice($service, $days, $pricetype) {

                $rate = 0;
                $ratecard = RateCard::find()->where(['service_id' => $service->service, 'branch_id' => $service->branch_id, 'status' => 1, 'sub_service' => $service->sub_service])->one();
                $service_dutytype = $service->duty_type;

                if ($service->frequency == 1 && ($service->duty_type == 3 || $service->duty_type == 4 || $service->duty_type == 5)) {
                        if (isset($service->rate_card_value)) {
                                $rate = $days * $service->rate_card_value;
                        }
                } else {
                        $total_hours = $service->hours * $days;
                        if (isset($service->rate_card_value)) {
                                $rate = $total_hours * $service->rate_card_value;
                        }
                }


                if ($pricetype == 2) {
                        if ($service_dutytype == 5 && $service->day_night_staff == 2) {
                                $rate = $rate / 2;
                        }
                        $price = $service->estimated_price - $rate;
                } else {
                        $price = $service->estimated_price + $rate;
                }
                return $price;
        }

        public function actionViewschedule() {
                if (Yii::$app->request->isAjax) {
                        $schedule = ServiceSchedule::findOne($_POST['schedule_id']);
                        $view = $this->renderPartial('view_schedule', ['schedule' => $schedule]);
                        echo $view;
                }
        }

}
