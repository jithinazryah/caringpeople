<?php

use yii\db\Migration;

/**
 * Handles the creation of table `folloup_history`.
 */
class m170329_051932_create_folloup_history_table extends Migration {

        /**
         * @inheritdoc
         */
        public function up() {
//                $this->createTable('followups', [
//                    'id' => $this->primaryKey(),
//                    'type' => $this->integer()->comment('0=client enquiry,1=client,2=staff enquiry,3=staffs'),
//                    'type_id' => $this->integer(),
//                    'followup_date' => $this->dateTime(),
//                    'followup_notes' => $this->text(),
//                    'assigned_to' => $this->integer(),
//                    'assigned_from' => $this->integer(),
//                    'DOC' => $this->date(),
//                ]);
                $this->addForeignKey("patient_general_id", "patient_enquiry_general_second", "enquiry_id", "patient_enquiry_general_first", "id", "RESTRICT", "RESTRICT");
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('folloup_history');
        }

}
