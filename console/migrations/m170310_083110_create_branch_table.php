<?php

use yii\db\Migration;

/**
 * Handles the creation of table `branch`.
 */
class m170310_083110_create_branch_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('branch', [
            'id' => $this->primaryKey(),
            'branch_name'=>$this->string(280),
            'branch_code'=>$this->string(280)->unique(),
            'country'=>$this->integer(),
            'state'=>$this->integer(),
            'city'=>$this->string(280),
            'contact_person_name'=>$this->string(280),
            'contact_person_number1'=>$this->string(280),
            'contact_person_number2'=>$this->string(280),
            'contact_person_email'=>$this->string(280),
            'status'=>$this->integer()->notNull(),
            'CB'=>$this->integer(),
            'UB'=>$this->integer(),
            'DOC' => $this->date(),
            'DOU' => $this->timestamp(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('branch');
    }
}
