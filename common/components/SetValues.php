<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SetValues
 *
 * @author user
 */

namespace common\components;

use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use common\models\MasterHistoryType;
use common\models\History;
use common\models\Service;
use common\models\NotificationViewStatus;
use common\models\StaffInfo;
use common\models\PatientGeneral;

class SetValues extends Component {

        public function Attributes($model) {

                if (isset($model) && !Yii::$app->user->isGuest) {
                        if ($model->isNewRecord) {
                                $model->CB = Yii::$app->user->identity->id;
                                $model->DOC = date('Y-m-d');
                        } else {
                                $model->UB = Yii::$app->user->identity->id;
                        }



                        return TRUE;
                } else {
                        return FALSE;
                }
        }

        public function currentBranch($model) {
                if ($model->isNewRecord) {
                        $model->branch_id = Yii::$app->user->identity->branch_id;
                }
                return true;
        }

        public function Selected($value) {
                $options = array();
                if (is_array($value)) {
                        $array = $value;
                } else {
                        $array = explode(',', $value);
                }

                foreach ($array as $valuee):
                        $options[$valuee] = ['selected' => true];
                endforeach;
                return $options;
        }

        public function ChangeFormate($date) {
                if ($date == Null || $date == '0000-00-00 00:00:00') {
                        return '(Not Set)';
                } else {
                        return date("d-M-Y h:i:s", strtotime($date));
                }
        }

        public function DateFormate($date) {
                $old = strtotime('1999-01-01 00:00:00');
                if ($date == Null || $date == '0000-00-00 00:00:00') {
                        return;
                } else {
                        $f = 'd-M-Y' . (date('H:i:s', strtotime($date)) != '00:00:00' ? ' H:i' : '');
                        return str_replace(' 00:00:00', '', date($f, strtotime($date)));
                }
        }

        public function NumberFormat($grandtotal) {
                $s = explode('.', $grandtotal);
                $amount = $s[0];
                $decimal = $s[1];
                if ($amount != '') {
                        $total = $english_format_number = number_format($amount);
                        if ($decimal != 0) {
                                $grandtotal = $total . '.' . $decimal;
                        } else {
                                $grandtotal = $total . '.00';
                        }
                        return $grandtotal;
                } else {
                        return;
                }
        }

        public function ServiceHistory($service, $master_history_type) {
                $master_history_type_model = MasterHistoryType::findOne($master_history_type);
                $service_data = Service::find()->where(['id' => $service])->one();
                $model = new History();
                $model->reference_id = $service->id;
                $model->history_type = $master_history_type;
                $model->content = $master_history_type_model->content . ' for patient ' . $service_data->patient->first_name . ' on ' . date('Y-m-d', strtotime($service_data->DOC));
                if ($model->save())
                        return $model->id;
                else
                        return FALSE;
        }

        public function Notifications($history_id, $service_id, $datas) {

                $history_model = History::find()->where(['id' => $history_id])->one();
                $service_model = Service::find()->where(['id' => $service_id])->one();
                if (!empty($datas)) {
                        foreach ($datas as $data) {

                                $model = new NotificationViewStatus();
                                $model->reference_id = $service_id;
                                $model->history_id = $history_id;
                                $model->notifiaction_type_id = $data[2];
                                $model->staff_type = $data[3];
                                $model->staff_id_ = $data[4];
                                $model->content = $history_model->content;
                                $model->date = date('Y-m-d', strtotime($service_model->DOU));
                                $model->view_status = 0;
                                $model->save();
                        }
                        return TRUE;
                } else {
                        return FALSE;
                }
        }

        /*
         * Followups-> assigned to dropdown
         */

        public function Assigned($service) {

                $data = [];
                $patient = PatientGeneral::findOne($service->patient_id);
                if ($service->staff_manager != '') {
                        $manager = StaffInfo::findOne($service->staff_manager);
                        $data3 = [$manager->id => $manager->staff_name . ' ( Staff Manager )'];
                } else {
                        $data3 = [];
                }
                $super_admins = StaffInfo::find()->where(['post_id' => 1, 'status' => 1])->all();
                $data2 = ArrayHelper::map($super_admins, 'id', 'fullname');


                if ($service->duty_type == '1') { /* day */

                        $daystaff = StaffInfo::findOne($service->day_staff);
                        $data = [$patient->id => $patient->first_name . ' ( Patient )', $daystaff->id => $daystaff->staff_name . ' ( Day Staff )',];
                } else if ($service->duty_type == '2') { /* night */

                        $nightstaff = StaffInfo::findOne($service->night_staff);
                        $data = [$patient->id => $patient->first_name . ' ( Patient )', $nightstaff->id => $nightstaff->staff_name . ' ( Night Staff )'];
                } else if ($service->duty_type == '3') { /* day & night */

                        $daystaff = StaffInfo::findOne($service->day_staff);
                        $nightstaff = StaffInfo::findOne($service->night_staff);
                        $data = [$patient->id => $patient->first_name . '    ( Patient )', $daystaff->id => $daystaff->staff_name . ' ( Day Staff )', $nightstaff->id => $nightstaff->staff_name . ' ( Night Staff )'];
                }

                $datas = $data + $data3 + $data2;
                return $datas;
        }

        /*
         * related staff options
         */

        public function Relatedstaffs($type, $type_id) {

                $related_staff = StaffInfo::find()->where(['<>', 'post_id', '1'])->andWhere(['status' => 1])->orderBy(['staff_name' => SORT_ASC])->all();
                $related_staff_data = ArrayHelper::map($related_staff, 'id', 'namepost');
                if ($type == '5') {
                        $service = Service::findOne($type_id);
                        $patient = PatientGeneral::findOne($service->patient_id);
                        $related_staff_data[$patient->id] = $patient->first_name . " (Patient)";
                }
                return $related_staff_data;
        }

        /*
         * repeated followups Days listing
         */

        public function Days() {
                $days = [];
                $days['sunday'] = 'Sunday';
                $days['monday'] = 'Monday';
                $days['tuesday'] = 'Tuesday';
                $days['wednesday'] = 'Wednesday';
                $days['thursday'] = 'Thursday';
                $days['friday'] = 'Friday';
                $days['saturday'] = 'Saturday';
                return $days;
        }

        /*
         * Repeated followups Dates listing
         */

        public function Dates() {
                $dates = [];
                for ($i = 1; $i <= 31; $i++) {
                        $dates[$i] = $i;
                }
                return $dates;
        }

}
