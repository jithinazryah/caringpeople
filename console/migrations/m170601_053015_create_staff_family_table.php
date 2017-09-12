<?php

use yii\db\Migration;

/**
 * Handles the creation of table `staff_family`.
 */
class m170601_053015_create_staff_family_table extends Migration {

        /**
         * @inheritdoc
         */
        public function up() {
                $this->createTable('staff_enquiry_family_details', [
                    'id' => $this->primaryKey(),
                    'enquiry_id' => $this->integer(),
                    'staff_id' => $this->integer(),
                    'name' => $this->string(250),
                    'relationship' => $this->string(250),
                    'job' => $this->string(250),
                    'mobile_no' => $this->string(250)
                ]);
                $this->addForeignKey("fk_staff_enq_id_1", "staff_enquiry_family_details", "enquiry_id", "staff_enquiry", "id", "RESTRICT", "RESTRICT");
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('staff_family');
        }

}
