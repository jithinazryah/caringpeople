<?php

use yii\db\Migration;

class m170623_051243_create extends Migration {

        public function safeUp() {

        }

        public function safeDown() {
                echo "m170623_051243_create cannot be reverted.\n";

                return false;
        }

        // Use up()/down() to run migration code without a transaction.
        public function up() {
                $this->addColumn('patient_enquiry_general_first', 'patient_id', 'integer');
                $this->addColumn('patient_enquiry_general_second', 'patient_id', 'integer');
                $this->addColumn('patient_enquiry_hospital_details', 'patient_id', 'integer');
                $this->addColumn('patient_enquiry_hospital_first', 'patient_id', 'integer');
                $this->addColumn('patient_enquiry_hospital_second', 'patient_id', 'integer');
        }

        public function down() {
                echo "m170623_051243_create cannot be reverted.\n";

                return false;
        }

}
