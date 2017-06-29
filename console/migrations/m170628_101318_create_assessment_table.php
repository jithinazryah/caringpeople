<?php

use yii\db\Migration;

/**
 * Handles the creation of table `assessment`.
 */
class m170628_101318_create_assessment_table extends Migration {

        /**
         * @inheritdoc
         */
        public function up() {
                $this->createTable('patient_assessment', [
                    'id' => $this->primaryKey(),
                    'pateient_id' => $this->integer(),
                    'service_id' => $this->integer(),
                    'patient_condition' => $this->integer(),
                    'patient_medical_procedures' => $this->string(200),
                    'suggested_professional' => $this->string(250),
                    'other_notes' => $this->text(),
                    'assessment_date' => $this->date(),
                    'assessed_by' => $this->string(250),
                ]);
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('assessment');
        }

}
