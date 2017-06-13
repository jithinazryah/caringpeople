<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "repeated_followups".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $sub_type
 * @property integer $type_id
 * @property string $followup_date
 * @property string $followup_notes
 * @property integer $assigned_to
 * @property integer $assigned_from
 * @property string $attachments
 * @property string $related_staffs
 * @property integer $repeated_type
 * @property string $repeated_days
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class RepeatedFollowups extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'repeated_followups';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['type', 'sub_type', 'type_id', 'assigned_to', 'assigned_from', 'repeated_type', 'status', 'CB', 'UB', 'releated_notification_patient'], 'integer'],
                        [['followup_date', 'DOC', 'DOU'], 'safe'],
                        [['followup_notes'], 'string'],
                        [['status'], 'required'],
                        [['attachments', 'related_staffs'], 'string', 'max' => 200],
                        [['repeated_days'], 'string', 'max' => 250],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'type' => 'Type',
                    'sub_type' => 'Sub Type',
                    'type_id' => 'Type ID',
                    'followup_date' => 'Followup Date',
                    'followup_notes' => 'Followup Notes',
                    'assigned_to' => 'Assigned To',
                    'assigned_from' => 'Assigned From',
                    'attachments' => 'Attachments',
                    'related_staffs' => 'Related Staffs',
                    'repeated_type' => 'Repeated Type',
                    'repeated_days' => 'Repeated Days',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                    'releated_notification_patient' => 'releated_notification_patient',
                ];
        }

}
