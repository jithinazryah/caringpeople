<?php

use yii\db\Migration;

/**
 * Handles the creation of table `staff_payment`.
 */
class m170801_093944_create_staff_payment_table extends Migration {

        /**
         * @inheritdoc
         */
        public function up() {
                $this->createTable('staff_payroll', [
                    'id' => $this->primaryKey(),
                    'branch_id' => $this->integer(),
                    'staff_id' => $this->integer(),
                    'month' => $this->string(200),
                    'year' => $this->string(200),
                    'type' => $this->integer()->comment('1=advance,2=payment'),
                    'amount' => $this->string(200),
                    'bank' => $this->integer(),
                    'reference_no' => $this->string(200),
                    'payment_date' => $this->payment_date(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->date(),
                    'DOU' => $this->dateTime(),
                ]);
                $this->addForeignKey("fk_payroll_staff_id", "staff_payroll", "staff_id", "staff_info", "id", "RESTRICT", "RESTRICT");

                $this->createTable('account_head', [
                    'id' => $this->primaryKey(),
                    'ac_holder' => $this->string(200),
                    'bank_name' => $this->string(200),
                    'account_no' => $this->string(200),
                    'ifsc_code' => $this->string(200),
                    'branch' => $this->string(200),
                    'branch_id' => $this->integer(),
                    'status' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->date(),
                    'DOU' => $this->dateTime(),
                ]);

                $this->createTable('referral_source', [
                    'id' => $this->primaryKey(),
                    'title' => $this->string(200),
                    'status' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->date(),
                    'DOU' => $this->dateTime(),
                ]);
                $this->createTable('accounts', [
                    'id' => $this->primaryKey(),
                    'branch_id' => $this->integer(),
                    'reference_type' => $this->integer()->comment('1=staff payroll,2=purchase,3=patient invoice'),
                    'invoice_id' => $this->integer(),
                    'debited_to_credited_by' => $this->integer(),
                    'type' => $this->integer()->comment('1=debit,2=credit'),
                    'purpose' => $this->string(200),
                    'payment_type' => $this->integer(),
                    'amount' => $this->string(200),
                    'payment_date' => $this->date(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->date(),
                    'DOU' => $this->dateTime(),
                ]);
                $this->createTable('service_schedule_history', [
                    'id' => $this->primaryKey(),
                    'service_id' => $this->integer(),
                    'type' => $this->integer()->comment('1=service create,2=add schedule,3=cancelled schedule'),
                    'schedules' => $this->integer(),
                    'price' => $this->decimal(10, 2),
                    'date' => $this->date(),
                ]);
                $this->createTable('invoice', [
                    'id' => $this->primaryKey(),
                    'branch_id' => $this->integer(),
                    'patient_id' => $this->integer(),
                    'service_id' => $this->integer(),
                    'type' => $this->integer(),
                    'amount' => $this->string(200),
                    'CB' => $this->integer(),
                    'DOC' => $this->date(),
                ]);
                $this->addColumn('service', 'due_amount', 'string(200)');
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('staff_payroll');
        }

}
