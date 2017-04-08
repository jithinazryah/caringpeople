<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patient_guardian_details".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property string $first_name
 * @property string $last_name
 * @property integer $gender
 * @property string $id_card_or_passport_no
 * @property string $religion
 * @property string $nationality
 * @property string $occupatiion
 * @property string $permanent_address
 * @property integer $pincode
 * @property string $landmark
 * @property integer $contact_number
 * @property string $email
 * @property string $adhar_card_no
 * @property string $passport
 * @property string $driving_license
 * @property string $pan_card
 * @property string $voters_id
 * @property string $guardian_profile_image
 */
class PatientGuardianDetails extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'patient_guardian_details';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
		    //[['id'], 'required'],
			[['id', 'patient_id', 'gender', 'pincode', 'contact_number'], 'integer'],
			[['permanent_address'], 'string'],
			[['first_name', 'last_name', 'id_card_or_passport_no', 'religion', 'nationality', 'occupatiion', 'landmark', 'email', 'adhar_card_no', 'passport', 'driving_license', 'pan_card', 'voters_id'], 'string', 'max' => 100],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'patient_id' => 'Patient ID',
		    'first_name' => 'First Name',
		    'last_name' => 'Last Name',
		    'gender' => 'Gender',
		    'id_card_or_passport_no' => 'Id Card/Passport No',
		    'religion' => 'Religion',
		    'nationality' => 'Nationality',
		    'occupatiion' => 'Occupatiion',
		    'permanent_address' => 'Permanent Address',
		    'pincode' => 'Pincode',
		    'landmark' => 'Landmark',
		    'contact_number' => 'Contact Number',
		    'email' => 'Email',
		    'adhar_card_no' => 'Adhar Card No',
		    'passport' => 'Passport',
		    'driving_license' => 'Driving License',
		    'pan_card' => 'Pan Card',
		    'voters_id' => 'Voters ID',
		    'guardian_profile_image' => 'Guardian Image',
		];
	}

}
