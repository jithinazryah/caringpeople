<?php

use yii\db\Migration;

/**
 * Handles the creation of table `staffenquiry`.
 */
class m170322_045706_create_staffenquiry_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('staffenquiry', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('staffenquiry');
    }
}
