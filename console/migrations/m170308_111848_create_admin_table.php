<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m170308_111848_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('adminposts', [
            'id' => $this->primaryKey(),
            'postname'=>$this->string(280),
            'enquiry'=>$this->integer(),
            'users'=>$this->integer(),
            'employees'=>$this->integer(),
            'status'=>$this->integer(),
            'cb'=>$this->integer(),
            'ub'=>$this->integer(),
            'doc' => $this->dateTime(),
            'dou' => $this->timestamp(),
        ]);
        
        
        $this->createTable('adminusers', [
            'id' => $this->primaryKey(),
            'postid'=>$this->integer(),
            'employeecode'=>$this->string(280),
            'username'=>$this->string(280),
            'password'=>$this->string(280),
            'name'=>$this->string(280),
            'email'=>$this->string(280),
            'phoneno'=>$this->string(280),
            'cb'=>$this->integer(),
            'ub'=>$this->integer(),
            'doc' => $this->dateTime(),
            'dou' => $this->timestamp(),
        ]);
        $this->addForeignKey(
            'fk-adminusers-postid',
            'adminusers',
            'postid',
            'adminposts',
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}
