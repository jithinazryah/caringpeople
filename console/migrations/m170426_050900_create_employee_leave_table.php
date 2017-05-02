<?php

use yii\db\Migration;

/**
 * Handles the creation of table `employee_leave`.
 */
class m170426_050900_create_employee_leave_table extends Migration {

	/**
	 * @inheritdoc
	 */
	public function up() {
//		$this->createTable('master_leave_type', [
//		    'id' => $this->primaryKey(),
//		    'type' => $this->string(),
//		    'status' => $this->integer(),
//		    'CB' => $this->integer(),
//		    'UB' => $this->integer(),
//		    'DOC' => $this->dateTime(),
//		    'DOU' => $this->timestamp(),
//		]);
//		$this->insert('master_leave_type', ['id' => '1', 'type' => 'Annual', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-04-20', 'DOU' => '2017-04-20 16:11:28']);
//		$this->insert('master_leave_type', ['id' => '2', 'type' => 'Sick', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-04-20', 'DOU' => '2017-04-20 16:11:28']);
//		$this->insert('master_leave_type', ['id' => '3', 'type' => 'Casual', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-04-20', 'DOU' => '2017-04-20 16:11:28']);
//		$this->insert('master_leave_type', ['id' => '4', 'type' => 'Half Day', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-04-20', 'DOU' => '2017-04-20 16:11:28']);
//		$this->createTable('staff_leave', [
//		    'id' => $this->primaryKey(),
//		    'employee_id' => $this->integer(),
//		    'no_of_days' => $this->integer(),
//		    'leave_type' => $this->integer(),
//		    'commencing_date' => $this->date(),
//		    'ending_date' => $this->date(),
//		    'purpose' => $this->text(),
//		    'CB' => $this->integer(),
//		    'DOC' => $this->dateTime(),
//		]);
//		$this->addForeignKey("leave_type", "staff_leave", "leave_type", "master_leave_type", "id", "RESTRICT", "RESTRICT");
//		$this->addColumn('staff_leave', 'status', $this->integer(11)->after('purpose'));
//		$this->addCommentOnColumn('staff_leave', 'status', '1->pending,2->approved,3->declined');
//		$this->addForeignKey("employee_id", "staff_leave", "employee_id", "admin_users", "id", "RESTRICT", "RESTRICT");
		$this->addColumn('staff_leave', 'admin_comment', $this->text()->after('purpose'));
	}

	/**
	 * @inheritdoc
	 */
	public function down() {
		$this->dropTable('staff_leave');
	}

}
