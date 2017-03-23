<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "staff_info".
 *
 * @property integer $id
 * @property string $staff_name
 * @property integer $gender
 * @property string $dob
 * @property string $blood_group
 * @property integer $religion
 * @property integer $caste
 * @property integer $nationality
 * @property string $pan_or_adhar_no
 * @property string $permanent_address
 * @property string $pincode
 * @property string $contact_no
 * @property string $email
 * @property string $present_address
 * @property string $present_pincode
 * @property string $present_contact_no
 * @property string $present_email
 * @property integer $years_of_experience
 * @property integer $driving_licence
 * @property string $licence_no
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
 * @property string $profile_image_type
 * @property integer $uniform
 * @property integer $company_id
 * @property integer $emergency_conatct_verification
 * @property integer $panchayath_cleraance_verification
 * @property string $biodata
 * @property integer $branch_id
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property Branch $branch
 * @property Caste $caste0
 * @property Religion $religion0
 * @property StaffOtherInfo[] $staffOtherInfos
 * @property StaffPerviousEmployer[] $staffPerviousEmployers
 */
class StaffInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staff_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gender', 'religion', 'caste', 'nationality', 'years_of_experience', 'driving_licence', 'sslc_year_of_passing', 'hse_year_of_passing', 'nursing_year_of_passing', 'timing', 'uniform', 'company_id', 'emergency_conatct_verification', 'panchayath_cleraance_verification', 'branch_id', 'status', 'CB', 'UB'], 'integer'],
            [['dob', 'DOC', 'DOU'], 'safe'],
            [['branch_id', 'status', 'CB', 'UB'], 'required'],
            [['staff_name', 'blood_group', 'pan_or_adhar_no', 'permanent_address', 'pincode', 'contact_no', 'email', 'present_address', 'present_pincode', 'present_contact_no', 'present_email', 'licence_no', 'sslc_institution', 'sslc_place', 'hse_institution', 'hse_place', 'nursing_institution', 'nursing_place', 'profile_image_type', 'biodata'], 'string', 'max' => 200],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['caste'], 'exist', 'skipOnError' => true, 'targetClass' => Caste::className(), 'targetAttribute' => ['caste' => 'id']],
            [['religion'], 'exist', 'skipOnError' => true, 'targetClass' => Religion::className(), 'targetAttribute' => ['religion' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'staff_name' => 'Staff Name',
            'gender' => 'Gender',
            'dob' => 'Dob',
            'blood_group' => 'Blood Group',
            'religion' => 'Religion',
            'caste' => 'Caste',
            'nationality' => 'Nationality',
            'pan_or_adhar_no' => 'Pan Or Adhar No',
            'permanent_address' => 'Permanent Address',
            'pincode' => 'Pincode',
            'contact_no' => 'Contact No',
            'email' => 'Email',
            'present_address' => 'Present Address',
            'present_pincode' => 'Present Pincode',
            'present_contact_no' => 'Present Contact No',
            'present_email' => 'Present Email',
            'years_of_experience' => 'Years Of Experience',
            'driving_licence' => 'Driving Licence',
            'licence_no' => 'Licence No',
            'sslc_institution' => 'Sslc Institution',
            'sslc_year_of_passing' => 'Sslc Year Of Passing',
            'sslc_place' => 'Sslc Place',
            'hse_institution' => 'Hse Institution',
            'hse_year_of_passing' => 'Hse Year Of Passing',
            'hse_place' => 'Hse Place',
            'nursing_institution' => 'Nursing Institution',
            'nursing_year_of_passing' => 'Nursing Year Of Passing',
            'nursing_place' => 'Nursing Place',
            'timing' => 'Timing',
            'profile_image_type' => 'Profile Image Type',
            'uniform' => 'Uniform',
            'company_id' => 'Company ID',
            'emergency_conatct_verification' => 'Emergency Conatct Verification',
            'panchayath_cleraance_verification' => 'Panchayath Cleraance Verification',
            'biodata' => 'Biodata',
            'branch_id' => 'Branch ID',
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
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaste0()
    {
        return $this->hasOne(Caste::className(), ['id' => 'caste']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReligion0()
    {
        return $this->hasOne(Religion::className(), ['id' => 'religion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffOtherInfos()
    {
        return $this->hasMany(StaffOtherInfo::className(), ['staff_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffPerviousEmployers()
    {
        return $this->hasMany(StaffPerviousEmployer::className(), ['staff_id' => 'id']);
    }
}
