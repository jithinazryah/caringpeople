<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patient_general".
 *
 * @property integer $id
 * @property integer $patient_enquiry_id
 * @property integer $branch_id
 * @property string $patient_id
 * @property string $first_name
 * @property string $last_name
 * @property integer $gender
 * @property integer $age
 * @property integer $weight
 * @property string $blood_group
 * @property string $patient_image
 * @property string $present_address
 * @property integer $pin_code
 * @property string $landmark
 * @property integer $contact_number
 * @property string $email
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class PatientGeneral extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'patient_general';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['patient_id', 'status', 'branch_id', 'first_name'], 'required'],
			[['id', 'patient_enquiry_id', 'branch_id', 'gender', 'age', 'pin_code', 'status', 'CB', 'UB'], 'integer'],
			[['present_address'], 'string'],
			['email', 'email'],
			[['DOC', 'DOU'], 'safe'],
			[['patient_id', 'first_name', 'last_name', 'patient_image', 'landmark', 'email'], 'string', 'max' => 100],
			[['blood_group'], 'string', 'max' => 50],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'patient_enquiry_id' => 'Patient Enquiry ID',
		    'branch_id' => 'Branch ID',
		    'patient_id' => 'Patient ID',
		    'first_name' => 'First Name',
		    'last_name' => 'Last Name',
		    'gender' => 'Gender',
		    'age' => 'Age',
		    'weight' => 'weight',
		    'blood_group' => 'Blood Group',
		    'patient_image' => 'Patient Image',
		    'present_address' => 'Present Address',
		    'pin_code' => 'Pin Code',
		    'landmark' => 'Landmark',
		    'contact_number' => 'Contact Number',
		    'email' => 'Email',
		    'status' => 'Status',
		    'CB' => 'Cb',
		    'UB' => 'Ub',
		    'DOC' => 'Doc',
		    'DOU' => 'Dou',
		];
	}

}
