<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "remarks".
 *
 * @property integer $id
 * @property integer $category
 * @property string $sub_category
 * @property string $notes
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property RemarksCategory $category0
 */
class Remarks extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'remarks';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['category'], 'required'],
                        [['category', 'status', 'CB', 'UB', 'type', 'type_id'], 'integer'],
                        [['notes'], 'string'],
                        [['DOC', 'DOU'], 'safe'],
                        [['sub_category'], 'string', 'max' => 200],
                        [['category'], 'exist', 'skipOnError' => true, 'targetClass' => RemarksCategory::className(), 'targetAttribute' => ['category' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'type' => 'type',
                    'type_id' => 'type_id',
                    'category' => 'Category',
                    'sub_category' => 'Sub Category',
                    'notes' => 'Notes',
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
        public function getCategory0() {
                return $this->hasOne(RemarksCategory::className(), ['id' => 'category']);
        }

}
