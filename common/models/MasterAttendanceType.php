<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "master_attendance_type".
 *
 * @property integer $id
 * @property string $type
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property AttendanceEntry[] $attendanceEntries
 */
class MasterAttendanceType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_attendance_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
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
    public function getAttendanceEntries()
    {
        return $this->hasMany(AttendanceEntry::className(), ['attendance' => 'id']);
    }
}
