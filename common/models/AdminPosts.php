<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "admin_posts".
 *
 * @property integer $id
 * @property string $post_name
 * @property integer $enquiry
 * @property integer $users
 * @property integer $employees
 * @property integer $status
 * @property integer $cb
 * @property integer $ub
 * @property string $doc
 * @property string $dou
 *
 * @property AdminUsers[] $adminUsers
 */
class AdminPosts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enquiry', 'users', 'employees', 'status', 'cb', 'ub'], 'integer'],
            [['doc', 'dou'], 'safe'],
            [['post_name'], 'string', 'max' => 280],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_name' => 'Post Name',
            'enquiry' => 'Enquiry',
            'users' => 'Users',
            'employees' => 'Employees',
            'status' => 'Status',
            'cb' => 'Cb',
            'ub' => 'Ub',
            'doc' => 'Doc',
            'dou' => 'Dou',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdminUsers()
    {
        return $this->hasMany(AdminUsers::className(), ['postid' => 'id']);
    }
}
