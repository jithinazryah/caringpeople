<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "enquiry_other_info".
 *
 * @property integer $id
 * @property integer $enquiry_id
 * @property integer $family_support
 * @property string $family_support_note
 * @property integer $care_currently_provided
 * @property string $details_of_current_care
 * @property integer $difficulty_in_movement
 * @property string $difficulty_in_movement_other
 * @property integer $service_required
 * @property string $service_required_other
 * @property string $how_long_service_required
 * @property string $nursing_assessment
 * @property string $doctor_assessment
 * @property string $follow_up_notes
 * @property string $quotation_details
 * @property integer $priority
 * @property string $followup_date
 *
 * @property Enquiry $enquiry
 */
class EnquiryOtherInfo extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'enquiry_other_info';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['enquiry_id', 'family_support', 'care_currently_provided', 'difficulty_in_movement', 'service_required', 'priority'], 'integer'],
                        [['follow_up_notes', 'quotation_details'], 'string'],
                        [['followup_date'], 'safe'],
                        [['family_support_note', 'details_of_current_care', 'difficulty_in_movement_other', 'service_required_other', 'how_long_service_required', 'nursing_assessment', 'doctor_assessment'], 'string', 'max' => 200],
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
                    'family_support' => 'Nearby Family Support',
                    'family_support_note' => 'Nearby Family Support Note',
                    'care_currently_provided' => 'Care Currently Being Provided',
                    'details_of_current_care' => 'Details Of Current Care',
                    'difficulty_in_movement' => 'Difficulty In Movement Or Getting Around The House',
                    'difficulty_in_movement_other' => 'Other Details',
                    'service_required' => 'Service Required',
                    'service_required_other' => 'Other Details',
                    'how_long_service_required' => 'How Long Service Required',
                    'nursing_assessment' => 'Nursing Assessment',
                    'doctor_assessment' => 'Doctor Assessment',
                    'follow_up_notes' => 'Follow Up Notes',
                    'quotation_details' => 'Quotation Details',
                    'priority' => 'Priority',
                    'followup_date' => 'Followup Date',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getEnquiry() {
                return $this->hasOne(Enquiry::className(), ['id' => 'enquiry_id']);
        }

}
