<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "history".
 *
 * @property integer $id
 * @property string $type
 * @property integer $type_id
 * @property integer $user_id
 * @property string $action
 * @property string $data
 * @property string $date
 */
class History extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'user_id'], 'integer'],
            [['user_id'], 'required'],
            [['data'], 'string'],
            [['date'], 'safe'],
            [['type', 'action'], 'string', 'max' => 100],
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
            'type_id' => 'Type ID',
            'user_id' => 'User ID',
            'action' => 'Action',
            'data' => 'Data',
            'date' => 'Date',
        ];
    }
}
