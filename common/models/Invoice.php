<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property integer $id
 * @property integer $branch_id
 * @property integer $patient_id
 * @property integer $service_id
 * @property integer $type
 * @property string $amount
 * @property integer $CB
 * @property string $DOC
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_id', 'patient_id', 'service_id', 'type', 'CB'], 'integer'],
            [['DOC'], 'safe'],
            [['amount'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'branch_id' => 'Branch ID',
            'patient_id' => 'Patient ID',
            'service_id' => 'Service ID',
            'type' => 'Type',
            'amount' => 'Amount',
            'CB' => 'Cb',
            'DOC' => 'Doc',
        ];
    }
}
