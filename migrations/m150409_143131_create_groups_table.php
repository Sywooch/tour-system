<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_143131_create_groups_table extends Migration
{
    public function up()
    {
        $this->createTable('groups', [
            'groupId' => Schema::TYPE_PK,
            'groupName' => Schema::TYPE_STRING . '(45) NOT NULL'
        ]);
    }

    public function down()
    {
        $this->dropTable('groups');
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
