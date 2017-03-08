<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "admin_users".
 *
 * @property integer $id
 * @property integer $postid
 * @property string $employee_code
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $email
 * @property string $phoneno
 * @property integer $cb
 * @property integer $ub
 * @property string $doc
 * @property string $dou
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
            [['postid', 'cb', 'ub'], 'integer'],
            [['doc', 'dou'], 'safe'],
            [['employee_code', 'username', 'password', 'name', 'email', 'phoneno'], 'string', 'max' => 280],
            [['postid'], 'exist', 'skipOnError' => true, 'targetClass' => AdminPosts::className(), 'targetAttribute' => ['postid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'postid' => 'Postid',
            'employee_code' => 'Employee Code',
            'username' => 'Username',
            'password' => 'Password',
            'name' => 'Name',
            'email' => 'Email',
            'phoneno' => 'Phoneno',
            'cb' => 'Cb',
            'ub' => 'Ub',
            'doc' => 'Doc',
            'dou' => 'Dou',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(AdminPosts::className(), ['id' => 'postid']);
    }
}
