<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service`.
 */
class m170428_114656_create_service_table extends Migration {

	/**
	 * @inheritdoc
	 */
	public function up() {
//		$this->createTable('service', [
//		    'id' => $this->primaryKey(),
//		    'patient_id' => $this->integer(),
//		    'service' => $this->integer(),
//		    'staff_type' => $this->integer(),
//		    'staff_id' => $this->integer(),
//		    'staff_manager' => $this->integer(),
//		    'from_date' => $this->date(),
//		    'to_date' => $this->date(),
//		    'estimated_price_per_day' => $this->string(),
//		    'estimated_price' => $this->string(),
//		    'advance_payment' => $this->string(),
//		    'status' => $this->integer(),
//		    'CB' => $this->integer(),
//		    'UB' => $this->integer(),
//		    'DOC' => $this->dateTime(),
//		    'DOU' => $this->timestamp(),
//		]);
//		$this->addForeignKey("patient_id", "service", "patient_id", "patient_general", "id", "RESTRICT", "RESTRICT");
//		$this->addForeignKey("service", "service", "service", "master_service_types", "id", "RESTRICT", "RESTRICT");
//		$this->addForeignKey("staff_id", "service", "staff_id", "staff_info", "id", "RESTRICT", "RESTRICT");
//		$this->addForeignKey("staff_manager", "service", "staff_manager", "staff_info", "id", "RESTRICT", "RESTRICT");
//		$this->addCommentOnColumn('service', 'staff_type', '1->Registered Nurse,2->Care Assistant,3->Doctor');
//		$this->addColumn('service', 'day_staff', 'integer(11) AFTER staff_type');
//		$this->addColumn('service', 'night_staff', 'integer(11) AFTER staff_type');
		//$this->addColumn('service', 'duty_type', 'integer(11) AFTER staff_type');
		$this->addColumn('service', 'service_id', 'string() AFTER id');
		$this->addColumn('service', 'branch_id', 'integer(11) AFTER advance_payment');
		$this->addColumn('service', 'staff_advance_payment', 'string(100) AFTER estimated_price');
		$this->addColumn('service', 'patient_advance_payment', 'string(100) AFTER staff_advance_payment');
	}

	/**
	 * @inheritdoc
	 */
	public function down() {
//		$this->dropColumn('service', 'staff_id');
		$this->dropColumn('service', 'advance_payment');
	}

}
