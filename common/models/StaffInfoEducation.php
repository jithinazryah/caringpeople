<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "staff_info_education".
 *
 * @property integer $id
 * @property string $staff_id
 * @property string $sslc_institution
 * @property integer $sslc_year_of_passing
 * @property string $sslc_place
 * @property string $hse_institution
 * @property integer $hse_year_of_passing
 * @property string $hse_place
 * @property string $nursing_institution
 * @property integer $nursing_year_of_passing
 * @property string $nursing_place
 * @property integer $timing
 * @property integer $uniform
 * @property integer $company_id
 * @property integer $emergency_conatct_verification
 * @property integer $panchayath_cleraance_verification
 */
class StaffInfoEducation extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'staff_info_education';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['sslc_year_of_passing', 'hse_year_of_passing', 'nursing_year_of_passing', 'timing', 'uniform', 'company_id', 'emergency_conatct_verification', 'panchayath_cleraance_verification'], 'integer'],
                        [['staff_id', 'sslc_institution', 'sslc_place', 'hse_institution', 'hse_place', 'nursing_institution', 'nursing_place'], 'string', 'max' => 200],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'staff_id' => 'Staff ID',
                    'sslc_institution' => 'Institution',
                    'sslc_year_of_passing' => ' Year Of Passing',
                    'sslc_place' => 'Place',
                    'hse_institution' => 'Institution',
                    'hse_year_of_passing' => 'Passing',
                    'hse_place' => 'Place',
                    'nursing_institution' => 'Institution',
                    'nursing_year_of_passing' => 'Year Of Passing',
                    'nursing_place' => 'Place',
                    'timing' => 'Timing',
                    'uniform' => 'Uniform?',
                    'company_id' => 'Company ID?',
                    'emergency_conatct_verification' => 'Emergency Conatct Verification?',
                    'panchayath_cleraance_verification' => 'Panchayath Cleraance Verification?',
                ];
        }

}
