<?php

use yii\db\Migration;

class m170316_115452_history extends Migration {

        public function up() {
                $tableOptions = null;
                if ($this->db->driverName === 'mysql') {
                        // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
                }

                $this->createTable('{{%history}}', [
                    'id' => $this->primaryKey(),
                    'type' => $this->string(100)->Null(),
                    'type_id' => $this->integer()->Null(),
                    'user_id' => $this->integer()->notNull(),
                    'action' => $this->string(100)->Null(),
                    'data' => $this->text()->Null(),
                    'date' => $this->dateTime(),
                        ], $tableOptions);
                $this->alterColumn('{{%history}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');
        }

        public function down() {
                echo "m170316_115452_history cannot be reverted.\n";

                return false;
        }

        /*
          // Use safeUp/safeDown to run migration code within a transaction
          public function safeUp()
          {
          }

          public function safeDown()
          {
          }
         */
}
