<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "staff_leave".
 *
 * @property integer $id
 * @property integer $employee_id
 * @property integer $info_table_id
 * @property integer $no_of_days
 * @property integer $leave_type
 * @property string $commencing_date
 * @property string $ending_date
 * @property string $purpose
 * @property integer $status
 * @property integer $CB
 * @property string $DOC
 *
 * @property StaffInfo $employee
 * @property MasterLeaveType $leaveType
 */
class StaffLeave extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staff_leave';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id', 'info_table_id', 'no_of_days', 'leave_type', 'status', 'CB'], 'integer'],
            [['commencing_date', 'ending_date', 'DOC'], 'safe'],
            [['purpose'], 'string'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => StaffInfo::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['leave_type'], 'exist', 'skipOnError' => true, 'targetClass' => MasterLeaveType::className(), 'targetAttribute' => ['leave_type' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'info_table_id' => 'Info Table ID',
            'no_of_days' => 'No Of Days',
            'leave_type' => 'Leave Type',
            'commencing_date' => 'Commencing Date',
            'ending_date' => 'Ending Date',
            'purpose' => 'Purpose',
            'status' => 'Status',
            'CB' => 'Cb',
            'DOC' => 'Doc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(StaffInfo::className(), ['id' => 'employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeaveType()
    {
        return $this->hasOne(MasterLeaveType::className(), ['id' => 'leave_type']);
    }
}
