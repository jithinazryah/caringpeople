<?php

use yii\db\Migration;

class m171110_034726_create_login_history extends Migration {

        public function safeUp() {
                $this->createTable('login_history', [
                    'id' => $this->primaryKey(),
                    'type' => $this->integer()->comment('1=satff,2=patient'),
                    'staff_id' => $this->integer(),
                    'patient_id' => $this->integer(),
                    'logged_in' => $this->dateTime(),
                    'logged_out' => $this->dateTime(),
                    'DOC' => $this->date(),
                    'DOU' => $this->dateTime(),
                ]);
        }

        public function safeDown() {
                echo "m171110_034726_create_login_history cannot be reverted.\n";

                return false;
        }

        /*
          // Use up()/down() to run migration code without a transaction.
          public function up()
          {

          }

          public function down()
          {
          echo "m171110_034726_create_login_history cannot be reverted.\n";

          return false;
          }
         */
}
