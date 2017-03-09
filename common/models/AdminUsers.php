<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "admin_users".
 *
 * @property integer $id
 * @property integer $post_ID
 * @property string $employee_code
 * @property string $user_name
 * @property string $password
 * @property string $name
 * @property string $email
 * @property string $phone_number
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property AdminPosts $post
 */
class AdminUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_ID', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['employee_code', 'user_name', 'password', 'name', 'email', 'phone_number'], 'string', 'max' => 280],
            [['post_ID'], 'exist', 'skipOnError' => true, 'targetClass' => AdminPosts::className(), 'targetAttribute' => ['post_ID' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_ID' => 'Post  ID',
            'employee_code' => 'Employee Code',
            'user_name' => 'User Name',
            'password' => 'Password',
            'name' => 'Name',
            'email' => 'Email',
            'phone_number' => 'Phone Number',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(AdminPosts::className(), ['id' => 'post_ID']);
    }
}
