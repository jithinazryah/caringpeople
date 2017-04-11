<?php

use yii\db\Migration;

/**
 * Handles the creation of table `patient_enquiry_hospital`.
 */
class m170411_043413_create_patient_enquiry_hospital_table extends Migration {

        /**
         * @inheritdoc
         */
        public function up() {
                $this->createTable('patient_enquiry_hospital_details', [
                    'id' => $this->primaryKey(),
                    'enquiry_id' => $this->integer(),
                    'hospital_name' => $this->string(),
                    'consultant_doctor' => $this->string(),
                    'department' => $this->string(),
                    'hospital_room_no' => $this->string(),
                ]);
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('patient_enquiry_hospital');
        }

}
