<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "enquiry_hospital".
 *
 * @property integer $id
 * @property integer $enquiry_id
 * @property string $hospital_name
 * @property string $consultant_doctor
 * @property string $hospital_room_no
 * @property string $required_service
 * @property string $other_services
 * @property string $diabetic
 * @property string $hypertension
 * @property string $tubes
 * @property string $feeding
 * @property string $urine
 * @property string $oxygen
 * @property string $tracheostomy
 * @property string $iv_line
 * @property string $dressing
 * @property string $home_or_hospital_visit
 * @property string $visit_date
 * @property string $bedridden
 *
 * @property Enquiry $enquiry
 */
class EnquiryHospital extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'enquiry_hospital';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['visit_date'], 'safe'],
                        [['bedridden'], 'string'],
                        [['hospital_name', 'consultant_doctor', 'hospital_room_no', 'required_service', 'other_services', 'diabetic', 'hypertension', 'tubes', 'feeding', 'urine', 'oxygen', 'tracheostomy', 'iv_line', 'dressing', 'home_or_hospital_visit'], 'string', 'max' => 200],
                        [['enquiry_id'], 'exist', 'skipOnError' => true, 'targetClass' => Enquiry::className(), 'targetAttribute' => ['enquiry_id' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'enquiry_id' => 'Enquiry ID',
                    'hospital_name' => 'Hospital Name',
                    'consultant_doctor' => 'Consultant Doctor',
                    'hospital_room_no' => 'Hospital Room No',
                    'required_service' => 'Required Service',
                    'other_services' => 'Other Services',
                    'diabetic' => 'Diabetic',
                    'hypertension' => 'Hypertension',
                    'tubes' => "Tube's",
                    'feeding' => 'Feeding',
                    'urine' => 'Urine',
                    'oxygen' => 'Oxygen',
                    'tracheostomy' => 'Tracheostomy',
                    'iv_line' => 'IV LINE',
                    'dressing' => 'Dressing',
                    'home_or_hospital_visit' => 'Home Or Hospital Visit',
                    'visit_date' => 'Hospital Visit Date',
                    'bedridden' => 'Notes',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getEnquiry() {
                return $this->hasOne(Enquiry::className(), ['id' => 'enquiry_id']);
        }

}
