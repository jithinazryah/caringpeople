<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property integer $id
 * @property integer $branch_id
 * @property integer $patient_id
 * @property integer $service_id
 * @property integer $type
 * @property string $total_amount
 * @property string $amount
 * @property string $due_amount
 * @property integer $CB
 * @property string $DOC
 */
class Invoice extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'invoice';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['branch_id', 'patient_id', 'service_id', 'type', 'CB'], 'integer'],
                        [['total_amount', 'amount', 'due_amount'], 'number'],
                        [['DOC'], 'safe'],
                        [['branch_id', 'patient_id'], 'required', 'on' => 'invoice'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'branch_id' => 'Branch',
                    'patient_id' => 'Patient',
                    'service_id' => 'Service ID',
                    'type' => 'Type',
                    'total_amount' => 'Total Amount',
                    'amount' => 'Amount',
                    'due_amount' => 'Due Amount',
                    'CB' => 'Cb',
                    'DOC' => 'Doc',
                ];
        }

}
