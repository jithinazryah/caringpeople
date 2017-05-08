<?php

use yii\db\Migration;

/**
 * Handles the creation of table `history`.
 */
class m170503_070056_create_history_table extends Migration {

	/**
	 * @inheritdoc
	 */
	public function up() {
		$this->createTable('history', [
		    'id' => $this->primaryKey(),
		    'reference_id' => $this->integer(),
		    'history_type' => $this->integer(),
		    'content' => $this->text(),
		    'date' => $this->date(),
		]);
		$this->addForeignKey("history_type", "history", "history_type", "master_history_type", "id", "RESTRICT", "RESTRICT");
	}

	/**
	 * @inheritdoc
	 */
	public function down() {
		$this->dropTable('history');
	}

}
