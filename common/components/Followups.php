<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;

use Yii;
use yii\base\Component;

class Followups extends Component {
        /*
         * Add followups to table Followups
         */

        public function Addfollowups($type, $type_id, $followup_info) {

                if ($followup_info->assigned_to != '') {
                        $followp = new \common\models\Followups;
                        $followp->type = $type;
                        $followp->type_id = $type_id;
                        $followp->followup_date = date('Y-m-d H:i:s', strtotime($followup_info->followup_date));
                        $followp->followup_notes = $followup_info->followup_notes;
                        $followp->assigned_to = $followup_info->assigned_to;
                        $followp->assigned_from = Yii::$app->user->identity->id;
                        if ($followup_info->status != 2)
                                $status = $this->Checkstatus($followup_info->followup_date, $followup_info->status);
                        else
                                $status = $followup_info->status;
                        $followp->DOC = date('Y-m-d');
                        $followp->save();
                }
        }

        /*
         * Update followups to table Followups
         */

        public function Updatefollowups($id, $followup_info) {
                $followp = \common\models\Followups::findOne($id);
                $followp->followup_date = date('Y-m-d H:i:s', strtotime($followup_info->followup_date));
                $followp->followup_notes = $followup_info->followup_notes;
                $followp->assigned_to = $followup_info->assigned_to;
                $followp->assigned_from = Yii::$app->user->identity->id;
                if ($followup_info->status != 2)
                        $status = $this->Checkstatus($followup_info->followup_date, $followup_info->status);
                else
                        $status = $followup_info->status;
                $followp->status = $status;
                $followp->update();
        }

        /*
         * check and change status of all Followups
         */

        public function Allfollowups() {
                $model = common\models\Followups::find()->where(['<>', 'status', '2'])->andWhere(['<>', 'status', '1'])->all();
                foreach ($model as $value) {
                        $status = $this->Checkstatus($value->followup_date, $value->status);
                        $value->status = $status;
                        $value->update();
                }
        }

        public function Checkstatus($followupdate, $status) {
                $followupdate = date('Y-m-d', strtotime($followupdate));
                $current_date = date('Y-m-d');
                $followupdate = date_create($followupdate);
                $current_date = date_create($current_date);

                $diff = date_diff($current_date, $followupdate);
                $date_difference = $diff->format("%R%a");
                if ($date_difference < 0) {
                        $status = '3';
                } else {
                        $status = $status;
                }
                return $status;
        }

}
