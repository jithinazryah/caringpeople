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
 * @property integer $staffs
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property AdminUsers[] $adminUsers
 */
class AdminPosts extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'admin_posts';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['post_name', 'enquiry', 'admin', 'masters', 'staffs', 'attendance', 'service', 'contact_directory', 'leave_application', 'leave_approval', 'rate_card', 'expenses'], 'required'],
                        [['admin', 'enquiry', 'users', 'employees', 'attendance', 'status', 'CB', 'UB', 'rate_card', 'expenses'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['post_name'], 'string', 'max' => 280],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'post_name' => 'Post Name',
                    'admin' => 'Admin',
                    'masters' => 'Masters',
                    'enquiry' => 'Enquiry',
                    'staffs' => 'Staffs',
                    'attendance' => 'Attendance',
                    'service' => 'Service',
                    'users' => 'Users',
                    'employees' => 'Employees',
                    'contact_directory' => 'Contact Directory',
                    'rate_card' => 'Rate card',
                    'expenses' => 'Expenses',
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
        public function getAdminUsers() {
                return $this->hasMany(AdminUsers::className(), ['post_id' => 'id']);
        }

}
