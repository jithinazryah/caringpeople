<?php

use yii\db\Migration;

/**
 * Handles the creation of table `staffenquiry`.
 */
class m170322_045706_create_staffenquiry_table extends Migration {

        /**
         * @inheritdoc
         */
        public function up() {
                $this->createTable('staff_enquiry', [
                    'id' => $this->primaryKey(),
                    'branch_id' => $this->integer(),
                    'name' => $this->string(200),
                    'phone_number' => $this->string(200),
                    'email' => $this->string(200),
                    'address' => $this->string(200),
                    'follow_up_date' => $this->timestamp(),
                    'notes' => $this->text(),
                    'status' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                ]);

                $this->addForeignKey("branchid", "staff_enquiry", "branch_id", "branch", "id", "RESTRICT", "RESTRICT");
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('staffenquiry');
        }

}
