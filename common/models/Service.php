<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property integer $service_id
 * @property integer $service
 * @property integer $staff_type
 * @property integer $staff_id
 * @property integer $staff_manager
 * @property string $from_date
 * @property string $to_date
 * @property string $estimated_price_per_day
 * @property string $estimated_price
 * @property string $staff_advance_payment
 * @property string $patient_advance_payment
 * @property string $branch_id
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property PatientGeneral $patient
 * @property MasterServiceTypes $service0
 * @property StaffInfo $staff
 * @property StaffInfo $staffManager
 */
class Service extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'service';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['patient_id', 'service', 'staff_type', 'staff_id', 'staff_manager', 'status', 'CB', 'UB'], 'integer'],
			[['from_date', 'to_date', 'DOC', 'DOU'], 'safe'],
			[['estimated_price_per_day', 'estimated_price', 'staff_advance_payment', 'staff_advance_payment'], 'string', 'max' => 255],
			[['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => PatientGeneral::className(), 'targetAttribute' => ['patient_id' => 'id']],
			[['service'], 'exist', 'skipOnError' => true, 'targetClass' => MasterServiceTypes::className(), 'targetAttribute' => ['service' => 'id']],
			[['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => StaffInfo::className(), 'targetAttribute' => ['staff_id' => 'id']],
			[['staff_manager'], 'exist', 'skipOnError' => true, 'targetClass' => StaffInfo::className(), 'targetAttribute' => ['staff_manager' => 'id']],
			[['patient_id', 'service', 'staff_type', 'from_date', 'to_date', 'status'], 'required', 'on' => 'create'],
			[['branch_id', 'service_id'], 'required', 'on' => 'create']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'patient_id' => 'Patient',
		    'service' => 'Service Type',
		    'staff_type' => 'Staff Type',
		    'staff_id' => 'Staff',
		    'staff_manager' => 'Staff Manager',
		    'duty_type' => 'Duty Type',
		    'day_staff' => 'Day Staff',
		    'night_staff' => 'Night Staff',
		    'staff_manager' => 'Staff Manager',
		    'from_date' => 'From Date',
		    'to_date' => 'To Date',
		    'estimated_price_per_day' => 'Estimated Price/Day',
		    'estimated_price' => 'Estimated Price',
		    'staff_advance_payment' => 'Staff Advance Payment',
		    'patient_advance_payment' => 'Patient Advance Payment',
		    'branch_id' => 'Branch',
		    'status' => 'Status',
		    'CB' => 'Cb',
		    'UB' => 'Ub',
		    'DOC' => 'Doc',
		    'DOU' => 'Dou',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPatient() {
		return $this->hasOne(PatientGeneral::className(), ['id' => 'patient_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getService0() {
		return $this->hasOne(MasterServiceTypes::className(), ['id' => 'service']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getStaff() {
		return $this->hasOne(StaffInfo::className(), ['id' => 'staff_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getStaffManager() {
		return $this->hasOne(StaffInfo::className(), ['id' => 'staff_manager']);
	}

	public function getBranch() {
		return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
	}

}
