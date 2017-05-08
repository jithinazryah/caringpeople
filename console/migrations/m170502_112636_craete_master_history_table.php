<?php

use yii\db\Migration;

class m170502_112636_craete_master_history_table extends Migration {

	public function up() {
		$this->createTable('master_history_type', [
		    'id' => $this->primaryKey(),
		    'type' => $this->string(),
		    'content' => $this->text(),
		    'status' => $this->integer(),
		    'CB' => $this->integer(),
		    'UB' => $this->integer(),
		    'DOC' => $this->dateTime(),
		    'DOU' => $this->timestamp(),
		]);
		$this->insert('master_history_type', ['id' => '1', 'type' => 'new service', 'content' => 'A new service is opened', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-05-02', 'DOU' => '2017-05-02 17:02:28']);
	}

	public function down() {
		echo "m170502_112636_craete_master_history_table cannot be reverted.\n";

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
