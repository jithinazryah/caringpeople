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
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
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
            [['enquiry', 'users', 'employees', 'status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
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
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdminUsers()
    {
        return $this->hasMany(AdminUsers::className(), ['post_ID' => 'id']);
    }
}
