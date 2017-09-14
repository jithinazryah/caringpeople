<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service`.
 */
class m170428_114656_create_service_table extends Migration {

        /**
         * @inheritdoc
         */
        public function up() {
                $this->createTable('service', [
                    'id' => $this->primaryKey(),
                    'branch_id' => $this->integer(),
                    'service_id' => $this->string(),
                    'patient_id' => $this->integer(),
                    'service' => $this->integer(),
                    'sub_service' => $this->integer(),
                    'gender_preference' => $this->integer()->comment('0=male,1=female,2=any'),
                    'duty_type' => $this->integer()->comment('1=hourly,2=visit,3=day,4=night,5=day and night'),
                    'day_night_staff' => $this->integer(),
                    'staff_manager' => $this->integer(),
                    'from_date' => $this->date(),
                    'to_date' => $this->date(),
                    'estimated_price_per_day' => $this->string(),
                    'estimated_price' => $this->string(),
                    'advance_payment' => $this->string(),
                    'status' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                ]);
                $this->addForeignKey("patient_id", "service", "patient_id", "patient_general", "id", "RESTRICT", "RESTRICT");
                $this->addForeignKey("service", "service", "service", "master_service_types", "id", "RESTRICT", "RESTRICT");
                $this->addForeignKey("staff_manager", "service", "staff_manager", "staff_info", "id", "RESTRICT", "RESTRICT");
        }

        /**
         * @inheritdoc
         */
        public function down() {
//		$this->dropColumn('service', 'staff_id');
                $this->dropColumn('service', 'advance_payment');
        }

}
