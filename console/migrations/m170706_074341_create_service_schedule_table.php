<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service_schedule`.
 */
class m170706_074341_create_service_schedule_table extends Migration {

        /**
         * @inheritdoc
         */
        public function up() {
                $this->createTable('service_schedule', [
                    'id' => $this->primaryKey(),
                    'service_id' => $this->integer(),
                    'patient_id' => $this->integer(),
                    'date' => $this->date(),
                    'staff' => $this->integer(),
                    'remarks_from_manager' => $this->text(),
                    'remarks_from_staff' => $this->text(),
                    'remarks_from_patient' => $this->text(),
                    'rating' => $this->integer(),
                    'rate' => $this->string(200),
                    'patient_rate' => $this->string(200),
                    'time_in' => $this->string(200),
                    'time_out' => $this->string(200),
                    'status' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                ]);
                $this->addForeignKey("fk_schedule_service_id", "service_schedule", "service_id", "service", "id", "RESTRICT", "RESTRICT");
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('service_schedule');
        }

}
