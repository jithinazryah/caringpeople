<?php

use yii\db\Migration;

class m170517_073631_create_master_designations extends Migration {

	public function up() {
		$this->createTable('master_designations', [
		    'id' => $this->primaryKey(),
		    'title' => $this->string(),
		    'status' => $this->integer(),
		    'CB' => $this->integer(),
		    'UB' => $this->integer(),
		    'DOC' => $this->dateTime(),
		    'DOU' => $this->timestamp(),
		]);
		$this->insert('master_designations', ['id' => '1', 'title' => 'Registered Nurse', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-05-17', 'DOU' => '2017-05-17 13:02:28']);
		$this->insert('master_designations', ['id' => '2', 'title' => 'Care Assistant', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-05-17', 'DOU' => '2017-05-17 13:02:28']);
		$this->insert('master_designations', ['id' => '3', 'title' => 'Doctor visit at home', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-05-17', 'DOU' => '2017-05-17 13:02:28']);
		$this->insert('master_designations', ['id' => '4', 'title' => 'OP Clinic', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-05-17', 'DOU' => '2017-05-17 13:02:28']);
		$this->insert('master_designations', ['id' => '5', 'title' => 'DV + OP', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-05-17', 'DOU' => '2017-05-17 13:02:28']);
		$this->insert('master_designations', ['id' => '6', 'title' => 'Physio', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-05-17', 'DOU' => '2017-05-17 13:02:28']);
		$this->insert('master_designations', ['id' => '7', 'title' => 'Psychologist', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-05-17', 'DOU' => '2017-05-17 13:02:28']);
		$this->insert('master_designations', ['id' => '8', 'title' => 'Dietician', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-05-17', 'DOU' => '2017-05-17 13:02:28']);
		$this->insert('master_designations', ['id' => '9', 'title' => 'Receptionist', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-05-17', 'DOU' => '2017-05-17 13:02:28']);
		$this->insert('master_designations', ['id' => '10', 'title' => 'Office Staff', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-05-17', 'DOU' => '2017-05-17 13:02:28']);
	}

	public function down() {
		echo "m170502_112636_craete_master_designations_table cannot be reverted.\n";

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
