<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m170308_111848_create_admin_table extends Migration {

        /**
         * @inheritdoc
         */
        public function up() {
                $this->createTable('admin_posts', [
                    'id' => $this->primaryKey(),
                    'post_name' => $this->string(280),
                    'enquiry' => $this->integer(),
                    'admin' => $this->integer(),
                    'masters' => $this->integer(),
                    'staffs' => $this->integer(),
                    'attendance' => $this->integer(),
                    'users' => $this->integer(),
                    'employees' => $this->integer(),
                    'leave_application' => $this->integer(),
                    'leave_approval' => $this->integer(),
                    'service' => $this->integer(),
                    'contact_directory' => $this->integer(),
                    'rate_card' => $this->integer(),
                    'expenses' => $this->integer(),
                    'status' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                ]);


                $this->createTable('admin_users', [
                    'id' => $this->primaryKey(),
                    'post_id' => $this->integer(),
                    'employee_code' => $this->string(280),
                    'user_name' => $this->string(280),
                    'password' => $this->string(280),
                    'name' => $this->string(280),
                    'email' => $this->string(280),
                    'phone_number' => $this->string(280),
                    'branch_id' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                ]);


                $this->createTable('assessment_category', [
                    'id' => $this->primaryKey(),
                    'assessment_id' => $this->integer(),
                    'sub_category' => $this->string(280),
                    'status' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                ]);




                $this->addForeignKey(
                        'fk-admin_users-post_id', 'admin_users', 'post_id', 'admin_posts', 'id', 'CASCADE'
                );
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('admin');
        }

}
