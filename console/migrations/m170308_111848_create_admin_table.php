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
                    'staff_payroll' => $this->integer(),
                    'invoice' => $this->integer(),
                    'account_head' => $this->integer(),
                    'reports' => $this->integer(),
                    'inventory' => $this->integer(),
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

                $this->createTable('{{%base_unit}}', [
                    'id' => $this->primaryKey(),
                    'name' => $this->string(30)->notNull(),
                    'value' => $this->decimal(10, 2)->Null(),
                    'status' => $this->smallInteger()->notNull()->defaultValue(0),
                    'CB' => $this->integer()->notNull(),
                    'UB' => $this->integer()->notNull(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);
                $this->alterColumn('{{%base_unit}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');


                $this->createTable('{{%tax}}', [
                    'id' => $this->primaryKey(),
                    'name' => $this->string(10, 2)->notNull(),
                    'type' => $this->integer()->Null(),
                    'value' => $this->decimal()->Null(),
                    'status' => $this->smallInteger()->notNull()->defaultValue(0),
                    'CB' => $this->integer()->notNull(),
                    'UB' => $this->integer()->notNull(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);
                $this->alterColumn('{{%tax}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');

                $this->createTable('{{%serial_number}}', [
                    'id' => $this->primaryKey(),
                    'transaction' => $this->integer()->Null(),
                    'prefix' => $this->integer()->Null(),
                    'sequence_no' => $this->integer()->Null(),
                    'status' => $this->smallInteger()->notNull()->defaultValue(0),
                    'CB' => $this->integer()->notNull(),
                    'UB' => $this->integer()->notNull(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);
                $this->alterColumn('{{%serial_number}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');

                $this->createTable('{{%item_master}}', [
                    'id' => $this->primaryKey(),
                    'SKU' => $this->string(30)->notNull(),
                    'item_name' => $this->string(30)->notNull(),
                    'item_type' => $this->integer()->notNull(),
                    'tax_id' => $this->integer()->notNull(),
                    'base_unit_id' => $this->integer()->notNull(),
                    'MRP' => $this->decimal(10, 2)->Null(),
                    'retail_price' => $this->decimal(10, 2)->Null(),
                    'purchase_prce' => $this->decimal(10, 2)->Null(),
                    'item_cost' => $this->decimal(10, 2)->Null(),
                    'status' => $this->smallInteger()->notNull()->defaultValue(0),
                    'CB' => $this->integer()->notNull(),
                    'UB' => $this->integer()->notNull(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);
                $this->alterColumn('{{%item_master}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');

                $this->createIndex('tax', 'item_master', 'tax_id', false);
                $this->createIndex('base', 'item_master', 'base_unit_id', false);
                $this->addForeignKey("tax", "item_master", "tax_id", "tax", "id", "RESTRICT", "RESTRICT");
                $this->addForeignKey("base", "item_master", "base_unit_id", "base_unit", "id", "RESTRICT", "RESTRICT");


                $this->createTable('{{%business_partner}}', [
                    'id' => $this->primaryKey(),
                    'type' => $this->integer()->notNull(),
                    'name' => $this->string(30)->notNull(),
                    'phone' => $this->integer()->notNull(),
                    'email' => $this->string(100),
                    'city' => $this->integer()->Null(),
                    'status' => $this->smallInteger()->notNull()->defaultValue(0),
                    'CB' => $this->integer()->notNull(),
                    'UB' => $this->integer()->notNull(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);
                $this->alterColumn('{{%business_partner}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');
                $this->createIndex('city-id', 'business_partner', 'city', $unique = false);
                $this->addForeignKey("city", "business_partner", "city", "city", "id", "RESTRICT", "RESTRICT");



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
