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
 * @property string $city
 * @property string $contact_person_name
 * @property string $contact_person_number1
 * @property string $contact_person_number2
 * @property string $contact_person_email
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
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
            [['country', 'state', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['branch_name', 'branch_code', 'city', 'contact_person_name', 'contact_person_number1', 'contact_person_number2', 'contact_person_email'], 'string', 'max' => 280],
            [['branch_code'], 'unique'],
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
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }
}
