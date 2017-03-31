<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "followups".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $type_id
 * @property string $followup_date
 * @property string $followup_notes
 * @property integer $assigned_to
 * @property integer $assigned_from
 * @property string $DOC
 */
class Followups extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'followups';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['type', 'type_id', 'assigned_to', 'status'], 'integer'],
                        [['followup_date', 'DOC'], 'safe'],
                        [['followup_notes'], 'string'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'type' => 'Type',
                    'type_id' => 'Type ID',
                    'followup_date' => 'Followup Date',
                    'followup_notes' => 'Followup Notes',
                    'assigned_to' => 'Assigned To',
                    'assigned_from' => 'Assigned From',
                    'status' => 'Status',
                    'DOC' => 'Doc',
                ];
        }

}
