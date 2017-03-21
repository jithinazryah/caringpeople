<?php

use yii\db\Migration;

/**
 * Handles the creation of table `hospital`.
 */
class m170321_102113_create_hospital_table extends Migration {

        /**
         * @inheritdoc
         */
        public function up() {
                $this->createTable('hospital', [
                    'id' => $this->primaryKey(),
                    'hospital_name' => $this->string(280),
                    'contact_person' => $this->string(280),
                    'contact_email' => $this->string(280),
                    'contact_number' => $this->string(280),
                    'contact_number_2' => $this->string(280),
                    'address' => $this->string(280),
                    'status' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                ]);
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('hospital');
        }

}
