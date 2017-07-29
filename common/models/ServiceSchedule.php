<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_schedule".
 *
 * @property integer $id
 * @property integer $service_id
 * @property integer $patient_id
 * @property string $date
 * @property integer $staff
 * @property integer $attendance
 * @property string $notes
 * @property string $remarks_from_manager
 * @property string $remarks_from_staff
 * @property string $remarks_from_patient
 * @property string $attachment
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property Service $service
 */
class ServiceSchedule extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'service_schedule';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['service_id', 'patient_id', 'staff', 'status', 'CB', 'UB', 'rating'], 'integer'],
                        [['date', 'DOC', 'DOU'], 'safe'],
                        [['remarks_from_manager', 'remarks_from_staff', 'remarks_from_patient', 'time_in', 'time_out', 'patient_rate'], 'string'],
                        [['rate'], 'string', 'max' => 255],
                        [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
                        [['date', 'DOC', 'staff'], 'required', 'on' => 'staffreport'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'service_id' => 'Service ID',
                    'patient_id' => 'Patient ID',
                    'date' => ($this->scenario == 'staffreport' ? 'Date From' : 'Date'),
                    'staff' => 'Staff',
                    'remarks_from_manager' => 'Remarks From Manager',
                    'remarks_from_staff' => 'Remarks From Staff',
                    'remarks_from_patient' => 'Remarks From Patient',
                    'rating' => 'Rating',
                    'rate' => 'Rate',
                    'patient_rate' => 'Patient Rate',
                    'time_in' => 'Time In',
                    'time_out' => 'Time Out',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Date To',
                    'DOU' => 'Dou',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getService() {
                return $this->hasOne(Service::className(), ['id' => 'service_id']);
        }

}
