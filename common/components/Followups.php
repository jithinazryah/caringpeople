<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;

use Yii;
use yii\base\Component;
use yii\helpers\Json;

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
                        $service_patient = \common\models\Service::findOne($followup->type_id);
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

}
