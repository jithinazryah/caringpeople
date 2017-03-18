<?php

use yii\db\Migration;

/**
 * Handles the creation of table `branch`.
 */
class m170310_083110_create_branch_table extends Migration {

        /**
         * @inheritdoc
         */
        public function up() {
//        $this->createTable('branch', [
//            'id' => $this->primaryKey(),
//            'branch_name' => $this->string(280),
//            'branch_code' => $this->string(280)->unique(),
//            'country' => $this->integer(),
//            'state' => $this->integer(),
//            'city' => $this->integer(),
//            'contact_person_name' => $this->string(280),
//            'contact_person_number1' => $this->string(280),
//            'contact_person_number2' => $this->string(280),
//            'contact_person_email' => $this->string(280),
//            'status' => $this->integer()->notNull(),
//            'CB' => $this->integer(),
//            'UB' => $this->integer(),
//            'DOC' => $this->date(),
//            'DOU' => $this->timestamp(),
//        ]);
//
//        $this->addForeignKey('fk-branch-country', 'branch', 'country', 'country', 'id', 'CASCADE');
//        $this->addForeignKey('fk-branch-state', 'branch', 'state', 'state', 'id', 'CASCADE');
//        $this->addForeignKey('fk-branch-city', 'branch', 'city', 'city', 'id', 'CASCADE');
//                $this->insert('branch', ['id' => '1', 'branch_name' => 'Cochi', 'branch_code' => 'CPC', 'country' => '1', 'state' => '1', 'city' => '1', 'contact_person_name' => 'Caring People', 'contact_person_number1' => '04844033505', 'contact_person_number2' => '04844033505', 'contact_person_email' => 'info@caringpeople.in', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-03-10', 'DOU' => '2017-03-10 16:11:28']);
//                $this->insert('branch', ['id' => '2', 'branch_name' => 'Mumbai', 'branch_code' => 'CPM', 'country' => '1', 'state' => '5', 'city' => '6', 'contact_person_name' => 'Caring People', 'contact_person_number1' => '02240111351', 'contact_person_number2' => '02240111351', 'contact_person_email' => 'info@caringpeople.in', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-03-10', 'DOU' => '2017-03-10 16:11:28']);
//                $this->addColumn('enquiry', 'whatsapp_reply', 'INTEGER AFTER person_postal_code');
///
                $this->addColumn('enquiry', 'caller_gender', 'INTEGER AFTER caller_name');
                $this->addColumn('enquiry', 'person_gender', 'INTEGER AFTER service_required_for_others');
                $this->addColumn('enquiry', 'whatsapp_number', 'VARCHAR(200) AFTER whatsapp_reply');
                $this->addColumn('enquiry_hospital', 'diabetic_note', 'VARCHAR(200) AFTER diabetic');
                $this->alterColumn('enquiry_other_info', 'followup_date', 'datetime');
                $this->addColumn('enquiry_hospital', 'department', 'VARCHAR(200) AFTER consultant_doctor');
                $this->addColumn('enquiry_hospital', 'expected_date', 'VARCHAR(200) AFTER required_service');
                $this->addCommentOnColumn('enquiry_hospital', 'expected_date', 'Expected date of service needed');
                $this->renameColumn('enquiry_hospital', 'home_or_hospital_visit', 'visit_type');
                $this->addCommentOnColumn('enquiry_hospital', 'visit_type', '1=Hospital,0=Home');
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('branch');
        }

}
