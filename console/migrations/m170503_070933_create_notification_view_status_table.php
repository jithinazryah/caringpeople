<?php

use yii\db\Migration;

/**
 * Handles the creation of table `notification_view_status`.
 */
class m170503_070933_create_notification_view_status_table extends Migration {

	/**
	 * @inheritdoc
	 */
	public function up() {
		$this->createTable('notification_view_status', [
		    'id' => $this->primaryKey(),
		    'reference_id' => $this->integer(),
		    'history_id' => $this->integer(),
		    'notifiaction_type_id' => $this->integer(),
		    'staff_type' => $this->integer(),
		    'staff_id' => $this->integer(),
		    'content' => $this->text(),
		    'date' => $this->date(),
		]);
		$this->addForeignKey("history_id", "notification_view_status", "history_id", "history", "id", "RESTRICT", "RESTRICT");
		$this->addCommentOnColumn('notification_view_status', 'staff_type', '1->Day staff,2->Night Staff,3->Manager,4->superadmin');
		$this->addCommentOnColumn('notification_view_status', 'notifiaction_type_id', '1->service,2->task');
		$this->addColumn('notification_view_status', 'view_status', 'integer(11) AFTER content');
		$this->addCommentOnColumn('notification_view_status', 'view_status', '1->seen,0->unseen');
		$this->addForeignKey("staff_id_", "notification_view_status", "staff_id_", "staff_info", "id", "RESTRICT", "RESTRICT");
	}

	/**
	 * @inheritdoc
	 */
	public function down() {
		$this->dropTable('notification_view_status');
	}

}
