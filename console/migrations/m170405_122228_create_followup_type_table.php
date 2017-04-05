<?php

use yii\db\Migration;

/**
 * Handles the creation of table `followup_type`.
 */
class m170405_122228_create_followup_type_table extends Migration {

        /**
         * @inheritdoc
         */
        public function up() {
                $this->createTable('followup_type', [
                    'id' => $this->primaryKey(),
                    'type' => $this->string(200),
                    'status' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->date(),
                    'DOU' => $this->timestamp(),
                ]);

                $this->createTable('followup_sub_type', [
                    'id' => $this->primaryKey(),
                    'type_id' => $this->integer(),
                    'sub_type' => $this->string(200),
                    'status' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->date(),
                    'DOU' => $this->timestamp(),
                ]);
                $this->addForeignKey("typeid", "followup_sub_type", "type_id", "followup_type", "id", "RESTRICT", "RESTRICT");
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('followup_type');
        }

}
