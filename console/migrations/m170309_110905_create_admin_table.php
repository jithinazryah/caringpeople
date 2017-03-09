<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m170309_110905_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('admin_posts', 'admin', 'INTEGER AFTER post_name');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}
