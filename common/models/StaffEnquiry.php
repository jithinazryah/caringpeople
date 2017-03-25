<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "staff_enquiry".
 *
 * @property integer $id
 * @property integer $branch_id
 * @property string $name
 * @property string $phone_number
 * @property string $email
 * @property string $address
 * @property string $follow_up_date
 * @property string $notes
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 * @property string $proceed
 *
 * @property Branch $branch
 */
class StaffEnquiry extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'staff_enquiry';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['name', 'gender', 'phone_number', 'email', 'address', 'follow_up_date', 'status'], 'required'],
                        [['email'], 'email'],
                        [['branch_id', 'status', 'CB', 'UB', 'proceed', 'gender', 'staff_type'], 'integer'],
                        [['follow_up_date', 'DOC', 'DOU'], 'safe'],
                        [['notes'], 'string'],
                        [['name', 'phone_number', 'email', 'address'], 'string', 'max' => 200],
                        [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'branch_id' => 'Branch ID',
                    'name' => 'Name',
                    'gender' => 'Gender',
                    'staff_type' => 'Staff Tpe',
                    'phone_number' => 'Phone Number',
                    'email' => 'Email',
                    'address' => 'Address',
                    'follow_up_date' => 'Followup Date',
                    'notes' => 'Notes',
                    'status' => 'Status',
                    'proceed' => 'proceed',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getBranch() {
                return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
        }

}
