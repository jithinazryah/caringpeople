<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;

use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use common\models\StaffInfo;
use common\models\PatientGeneral;
use common\models\Service;

class Followups extends Component {
        /*
         * Add followups to table Followups
         */

        public function StoreData($followup, $val) {

                if ($val['type'] != 'NULL') {
                        $followup->type = $val['type'];
                } else {
                        $followup->type = $val['typed'];
                }
                $followup->type_id = $val['type_id'];
                $followup->sub_type = $val['sub_type'];
                $followup->followup_date = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $val['followup_date'])));
                $followup->assigned_to = $val['assigned_to'];
                $followup->assigned_to_type = $val['assigned_to_type'];
                $followup->followup_notes = $val['followup_notes'];
                $followup->assigned_from = Yii::$app->user->identity->id;
                $followup->related_staffs = $val['related_staffs'];
                if ($val['related-patient'] == '1') {
                        $service_patient = Service::findOne($followup->type_id);
                        $patient_id = $service_patient->patient_id;
                } else {
                        $patient_id = '';
                }
                $followup->releated_notification_patient = $patient_id;
                $followup->attachments = $val['name'];
                $followup->DOC = date('Y-m-d');
                $followup->CB = Yii::$app->user->identity->id;
                if (!empty($followup->assigned_to))
                        $followup->save(false);
                return $followup;
        }

        public function Addcronfollowup($followup, $val) {

                $followup->attributes = $val->attributes;
                $followup->followup_date = date('Y-m-d H:i:s');
                $followup->save(false);
                return $followup;
        }

        public function sendMail($add_followp, $assigned) {

                if ($assigned == '1') {
                        $email_to = \common\models\PatientGeneral::findOne($add_followp->assigned_to);
                } else {
                        $email_to = \common\models\StaffInfo::findOne($add_followp->assigned_to);
                }
                if (isset($email_to->email) && $email_to->email != '') {
                        $message = Yii::$app->mailer->compose('followup-assigned-mail', ['assigned_to' => $add_followp->assigned_to, 'type' => $add_followp->assigned_to_type]) // a view rendering result becomes the message body here
                                ->setFrom('info@caringpeople.in')
                                ->setTo($email_to->email)
                                ->setSubject('New Followup');
                        $message->send();
                        return TRUE;
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
                        $data2 = [$manager->id => $manager->staff_name . ' ( Staff Manager )'];
                } else {
                        $data2 = [];
                }
                $super_admins = StaffInfo::find()->where(['post_id' => 1, 'status' => 1])->all();
                $data2 = ArrayHelper::map($super_admins, 'id', 'fullname');

                if ($service->staff_manager != '') {
                        $manager = StaffInfo::findOne($service->staff_manager);
                        $data3 = [$manager->id => $manager->staff_name . ' ( Staff Manager )'];
                } else {
                        $data3 = [];
                }
                $service_staffs = \common\models\ServiceSchedule::find()->select('staff')->where(['service_id' => $service->id])->andWhere(['<>', 'status', '2'])->distinct()->all();
                if (!empty($service_staffs)) {
                        foreach ($service_staffs as $staffs) {
                                $staff_name = StaffInfo::findOne($staffs->staff);
                                $da[$staffs->staff] .= $staff_name->staff_name;
                        }
                } else {
                        $da = [];
                }





                $datas = $data + $data3 + $data2 + $da;
                return $datas;
        }

        /*
         * related staff options
         */

        public function Relatedstaffs($type, $type_id) {

                $related_staff = StaffInfo::find()->where(['status' => 1])->orderBy(['staff_name' => SORT_ASC])->all();
                $related_staff_data = ArrayHelper::map($related_staff, 'id', 'namepost');
                return $related_staff_data;
        }

        public function Selectedstaffs($type, $type_id) {
                /* Super admins */
                $admins = StaffInfo::find()->where(['post_id' => 1])->all();
                $selected_staff = ArrayHelper::map($admins, 'id', 'id');
                /* service related staff and patient */
                $service = Service::findOne($type_id);
//                $day_staff = StaffInfo::findOne($service->day_staff);
//                $night_staff = StaffInfo::findOne($service->night_staff);
//                $selected_staff[$service->day_staff] = $service->day_staff;
//                $selected_staff[$service->night_staff] = $service->night_staff;

                return $selected_staff;
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
