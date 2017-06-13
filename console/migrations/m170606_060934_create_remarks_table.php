<?php

use yii\db\Migration;

/**
 * Handles the creation of table `remarks`.
 */
class m170606_060934_create_remarks_table extends Migration {

        /**
         * @inheritdoc
         */
        public function up() {
//                $this->createTable('remarks_category', [
//                    'id' => $this->primaryKey(),
//                    'type' => $this->integer()->comment('1=patient,2=staff'),
//                    'category' => $this->string(200),
//                    'status' => $this->integer(),
//                    'CB' => $this->integer(),
//                    'UB' => $this->integer(),
//                    'DOC' => $this->dateTime(),
//                    'DOU' => $this->timestamp(),
//                ]);
//
//                $this->createTable('remarks', [
//                    'id' => $this->primaryKey(),
//                    'type' => $this->integer()->comment('1=patient,2=staff'),
//                    'type_id' => $this->integer(),
//                    'category' => $this->integer(),
//                    'sub_category' => $this->string(200),
//                    'notes' => $this->text(),
//                    'status' => $this->integer(),
//                    'CB' => $this->integer(),
//                    'UB' => $this->integer(),
//                    'DOC' => $this->dateTime(),
//                    'DOU' => $this->timestamp(),
//                ]);
//
//                $this->addForeignKey("fk_remark_category", "remarks", "category", "remarks_category", "id", "RESTRICT", "RESTRICT");
                $this->addColumn('followups', 'releated_notification_patient', 'integer');
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('remarks');
        }

}
