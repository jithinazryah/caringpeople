<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patient_enquiry_general_second".
 *
 * @property integer $id
 * @property integer $enquiry_id
 * @property string $address
 * @property string $city
 * @property string $zip_pc
 * @property string $email
 * @property string $email1
 * @property integer $whatsapp_reply
 * @property string $whatsapp_number
 * @property string $whatsapp_note
 * @property string $required_service
 * @property string $required_service_other
 * @property string $service_required
 * @property string $service_required_other
 * @property integer $expected_date_of_service
 * @property string $how_long_service_required
 * @property integer $visit_type
 * @property string $quotation_details
 * @property string $notes
 * @property integer $priority
 */
class PatientEnquiryGeneralSecond extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'patient_enquiry_general_second';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['required_service', 'priority'], 'required'],
                        [['email', 'email1'], 'email'],
                        [['enquiry_id', 'whatsapp_reply', 'visit_type', 'priority',], 'integer'],
                        [['whatsapp_note', 'quotation_details', 'notes'], 'string'],
                        [['address', 'email1', 'whatsapp_number', 'required_service_other', 'service_required', 'service_required_other', 'how_long_service_required'], 'string', 'max' => 200],
                        [['city', 'zip_pc', 'email'], 'string', 'max' => 100],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'enquiry_id' => 'Enquiry ID',
                    'address' => 'Address',
                    'city' => 'City',
                    'zip_pc' => 'Zip/Pc',
                    'email' => 'Email',
                    'email1' => 'Alternate Email',
                    'whatsapp_reply' => 'Whatsapp Reply',
                    'whatsapp_number' => 'Whatsapp Number',
                    'whatsapp_note' => 'Whatsapp Note',
                    'required_service' => 'Required Service',
                    'required_service_other' => 'Required Service Other',
                    'service_required' => 'Service Required',
                    'service_required_other' => 'Service Required Other',
                    'expected_date_of_service' => 'Expected Date Of Service',
                    'how_long_service_required' => 'How Long Service Required',
                    'visit_type' => 'Visit Type',
                    'quotation_details' => 'Quotation Details',
                    'notes' => 'Notes',
                    'priority' => 'Priority',
                ];
        }

}
