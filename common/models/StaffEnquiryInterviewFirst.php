<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "staff_enquiry_interview_first".
 *
 * @property integer $id
 * @property integer $staff_id
 * @property integer $age
 * @property integer $height
 * @property integer $weight
 * @property integer $smoke_or_drink
 * @property string $police_station_name
 * @property string $panchayat
 * @property string $muncipality_corporation
 * @property integer $mentioned_per_day_salary
 * @property string $family_name
 * @property integer $relation
 * @property string $job
 * @property string $mobile_no
 * @property integer $terms_conditions
 * @property string $language_1
 * @property string $language_2
 * @property string $language_3
 * @property string $language_4
 *
 * @property StaffInfo $staff
 */
class StaffEnquiryInterviewFirst extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'staff_enquiry_interview_first';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['staff_id', 'age', 'height', 'weight', 'smoke_or_drink', 'mentioned_per_day_salary', 'relation', 'terms_conditions'], 'integer'],
                        [['police_station_name', 'panchayat', 'family_name', 'job', 'mobile_no', 'language_1', 'language_2', 'language_3', 'language_4'], 'string', 'max' => 200],
                        [['muncipality_corporation'], 'string', 'max' => 255],
                        [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => StaffInfo::className(), 'targetAttribute' => ['staff_id' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'staff_id' => 'Staff ID',
                    'age' => 'Age',
                    'height' => 'Height',
                    'weight' => 'Weight',
                    'smoke_or_drink' => 'Smoke / Drink / Other',
                    'police_station_name' => 'Police Station Name',
                    'panchayat' => 'Panchayat',
                    'muncipality_corporation' => 'Muncipality / Corporation',
                    'mentioned_per_day_salary' => 'Mentioned Per Day Salary',
                    'family_name' => 'Name',
                    'relation' => 'Relationship',
                    'job' => 'Job',
                    'mobile_no' => 'Mobile No',
                    'terms_conditions' => 'I agree to the terms and conditions',
                    'language_1' => 'Language 1',
                    'language_2' => 'Language 2',
                    'language_3' => 'Language 3',
                    'language_4' => 'Language 4',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getStaff() {
                return $this->hasOne(StaffInfo::className(), ['id' => 'staff_id']);
        }

}
