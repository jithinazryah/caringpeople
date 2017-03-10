<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "branch".
 *
 * @property integer $id
 * @property string $branch_name
 * @property string $branch_code
 * @property integer $country
 * @property integer $state
 * @property integer $city
 * @property string $contact_person_name
 * @property string $contact_person_number1
 * @property string $contact_person_number2
 * @property string $contact_person_email
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property City $city0
 * @property Country $country0
 * @property State $state0
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country', 'state', 'city', 'status', 'CB', 'UB'], 'integer'],
            [['status'], 'required'],
            [['DOC', 'DOU'], 'safe'],
            [['branch_name', 'branch_code', 'contact_person_name', 'contact_person_number1', 'contact_person_number2', 'contact_person_email'], 'string', 'max' => 280],
            [['branch_code'], 'unique'],
            [['city'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city' => 'id']],
            [['country'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country' => 'id']],
            [['state'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['state' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'branch_name' => 'Branch Name',
            'branch_code' => 'Branch Code',
            'country' => 'Country',
            'state' => 'State',
            'city' => 'City',
            'contact_person_name' => 'Contact Person Name',
            'contact_person_number1' => 'Contact Person Number1',
            'contact_person_number2' => 'Contact Person Number2',
            'contact_person_email' => 'Contact Person Email',
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
    public function getCity0()
    {
        return $this->hasOne(City::className(), ['id' => 'city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry0()
    {
        return $this->hasOne(Country::className(), ['id' => 'country']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState0()
    {
        return $this->hasOne(State::className(), ['id' => 'state']);
    }
}
