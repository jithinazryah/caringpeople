<?php

use yii\db\Migration;

class m170518_102920_designation_add_data extends Migration {

	public function up() {
		$this->insert('master_designations', ['id' => '11', 'title' => 'Accountant', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-05-17', 'DOU' => '2017-05-17 13:02:28']);
		$this->insert('master_designations', ['id' => '12', 'title' => 'Nurse Manager', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-05-17', 'DOU' => '2017-05-17 13:02:28']);
	}

	public function down() {
		echo "m170518_102920_designation_add_data cannot be reverted.\n";

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
