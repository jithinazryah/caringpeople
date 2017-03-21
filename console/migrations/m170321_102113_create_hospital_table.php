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
                    'name' => $this->string(280),
                    'status' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                ]);
                $this->insert('hospital', ['id' => '1', 'name' => 'Lakeshore Hospital', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-03-20', 'DOU' => '2017-03-20 16:11:28']);
                $this->insert('hospital', ['id' => '2', 'name' => 'Apollo Hospital', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-03-20', 'DOU' => '2017-03-20 16:11:28']);
        }

        /**
         * @inheritdoc
         */
        public function down() {
                $this->dropTable('hospital');
        }

}
