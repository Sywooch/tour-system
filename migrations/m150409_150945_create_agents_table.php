<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_150945_create_agents_table extends Migration
{
    public function up()
    {
        $this->createTable('agents', [
            'agentId' => Schema::TYPE_PK,
            'user_userId' => Schema::TYPE_INTEGER ,
            'agentName' => Schema::TYPE_STRING . '(45) NOT NULL',
            'agentSurname' => Schema::TYPE_STRING . '(45) NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('agents');
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
