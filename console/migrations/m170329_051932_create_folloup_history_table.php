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
                $this->createTable('followups', [
                    'id' => $this->primaryKey(),
                    'type' => $this->integer()->comment('0=client enquiry,1=client,2=staff enquiry,3=staffs'),
                    'sub_type' => $this->integer(),
                    'type_id' => $this->integer(),
                    'followup_date' => $this->dateTime(),
                    'followup_notes' => $this->text(),
                    'assigned_to' => $this->integer(),
                    'assigned_from' => $this->integer(),
                    'assigned_to_type' => $this->integer(),
                    'related_staffs' => $this->string(200),
                    'releated_notification_patient' => $this->integer(),
                    'attachments' => $this->string(200),
                    'status' => $this->integer(),
                    'view' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->date(),
                    'DOU' => $this->timestamp(),
                ]);
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('folloup_history');
        }

}
