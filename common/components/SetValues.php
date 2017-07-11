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
         * Rating calculation based on remarks
         */

        public function Rating($id, $type) {

                $remarks = \common\models\Remarks::find()->where(['type_id' => $id])->andWhere(['not', ['remark_type' => null]])->all();
                $count = count($remarks);
                $good_count = 0;
                $bad_count = 0;
                foreach ($remarks as $value) {

                        if ($value->remark_type == '1') {
                                $good_count = $good_count + 1;
                        } else if ($value->remark_type == '0') {
                                $bad_count = $bad_count + 1;
                        }
                }
                $remark_notes = 'Remarks :' . count($remarks) . ' Good Remarks: ' . $good_count . ' Bad Remarks: ' . $bad_count;
                $rating = $good_count * 100 / $count;
                $ratings = round($rating);
                if ($type == '1') {
                        $patient = PatientGeneral::findOne($id);
                        $patient->count_of_remarks = $remark_notes;
                        $patient->average_point = $ratings;
                        $patient->update(false);
                } else if ($type == '2') {
                        $staff = StaffInfo::findOne($id);
                        $staff->count_of_remarks = $remark_notes;
                        $staff->average_point = $ratings;
                        $staff->update(false);
                }
        }

        /*
         * staff availabiltity
         */

        public function StaffAvailabilty($model, $before_updtate = null) {

                if ($model->day_staff != '' && $model->status == 1) { /* when add daystaff and the service status is opened */
                        $staff = StaffInfo::findOne($model->day_staff);
                        $staff->status = 3;
                        $staff->update();
                }
                if ($model->night_staff != '' && $model->status == 1) { /* when add nightstaff and the service status is opened */
                        $staff = StaffInfo::findOne($model->night_staff);
                        $staff->status = 3;
                        $staff->update();
                }

                /*
                 * for update case
                 */
                if (isset($before_updtate)) {
                        if ($model->status == 2) { /** when that service is closed * */
                                $day_staff = StaffInfo::findOne($before_updtate->day_staff);
                                $day_staff->status = 1;
                                $day_staff->update();

                                $night_staff = StaffInfo::findOne($model->night_staff);
                                $night_staff->status = 1;
                                $night_staff->update();
                        }
                        if ($model->day_staff != $before_updtate->day_staff) { /** when changing the day staff * */
                                $day_staff = StaffInfo::findOne($before_updtate->day_staff);
                                $day_staff->status = 1;
                                $day_staff->update();
                        }

                        if ($model->night_staff != $before_updtate->night_staff) { /** when changing the night staff * */
                                $night_staff = StaffInfo::findOne($before_updtate->night_staff);
                                $night_staff->status = 1;
                                $night_staff->update();
                        }
                }
        }

        /*
         * Service form duty type options
         */

        public function Dutytype($model) {

                $option1 = [];
                $option2 = [];
                $option3 = [];
                $option4 = [];
                $option5 = [];
                if (isset($model->rate_per_hour) && $model->rate_per_hour != '') {
                        $option1 = ['1' => 'Hourly'];
                } if (isset($model->rate_per_visit) && $model->rate_per_visit != '') {
                        $option2 = ['2' => 'Visit'];
                }if (isset($model->rate_per_day) && $model->rate_per_day != '') {
                        $option3 = ['3' => 'Day'];
                } if (isset($model->rate_per_night) && $model->rate_per_night != '') {
                        $option4 = ['4' => 'Night'];
                } if (isset($model->rate_per_day_night) && $model->rate_per_day_night != '') {
                        $option5 = ['5' => 'Day & Night'];
                }

                return $option1 + $option2 + $option3 + $option4 + $option5;
        }

        public function Experience() {
                $exp = [];
                $exp['5'] = '0-5 yrs';
                $exp['10'] = '5-10 yrs';
                $exp['15'] = '10-15 yrs';


                return $exp;
        }

}
