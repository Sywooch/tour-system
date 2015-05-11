<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_141711_create_user_table extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'userId' => Schema::TYPE_PK,
            'userLogin' => Schema::TYPE_STRING . '(45) NOT NULL',
            'userPassword' => Schema::TYPE_STRING . '(255) NOT NULL',
            'userEmail' => Schema::TYPE_STRING . '(65) NOT NULL',
            'groups_groupId' => Schema::TYPE_INTEGER . ' NOT NULL',
            'authKey' => Schema::TYPE_STRING . ' NOT NULL',
            'accessToken' => Schema::TYPE_STRING . ' NOT NULL'
        ]);
    }

    public function down()
    {
        $this->dropTable('user');
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
