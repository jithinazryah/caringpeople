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
                    'gender' => $this->integer()->comment('0=Male,1=Female'),
                    'phone_number' => $this->string(200),
                    'email' => $this->string(200),
                    'address' => $this->string(200),
                    'staff_type' => $this->integer(),
                    'follow_up_date' => $this->dateTime(),
                    'notes' => $this->text(),
                    'status' => $this->integer(),
                    'proceed' => $this->integer()->comment('1=Proceed to staff,0=not proceed'),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                ]);

                $this->addForeignKey("branchid", "staff_enquiry", "branch_id", "branch", "id", "RESTRICT", "RESTRICT");


                $this->createTable('religion', [
                    'id' => $this->primaryKey(),
                    'religion' => $this->string(200),
                    'status' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                ]);
                $this->insert('religion', ['id' => '1', 'religion' => 'Hindu', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-03-10', 'DOU' => '2017-03-10 16:11:28']);
                $this->insert('religion', ['id' => '2', 'religion' => 'Christian', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-03-10', 'DOU' => '2017-03-10 16:11:28']);
                $this->insert('religion', ['id' => '3', 'religion' => 'Muslim', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-03-10', 'DOU' => '2017-03-10 16:11:28']);

                $this->createTable('caste', [
                    'id' => $this->primaryKey(),
                    'r_id' => $this->integer(),
                    'caste' => $this->string(200),
                    'status' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                ]);
                $this->addForeignKey("religionid", "caste", "r_id", "religion", "id", "RESTRICT", "RESTRICT");
                $this->insert('caste', ['id' => '1', 'r_id' => '1', 'caste' => 'Nair', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-03-10', 'DOU' => '2017-03-10 16:11:28']);
                $this->insert('caste', ['id' => '2', 'r_id' => '2', 'caste' => 'Marthoma', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-03-10', 'DOU' => '2017-03-10 16:11:28']);
                $this->insert('caste', ['id' => '3', 'r_id' => '3', 'caste' => 'Muslim', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-03-10', 'DOU' => '2017-03-10 16:11:28']);


                $this->createTable('nationality', [
                    'id' => $this->primaryKey(),
                    'nationality' => $this->string(200),
                    'status' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                ]);
                $this->insert('nationality', ['id' => '3', 'nationality' => 'Indian', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-03-10', 'DOU' => '2017-03-10 16:11:28']);
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('staffenquiry');
        }

}
