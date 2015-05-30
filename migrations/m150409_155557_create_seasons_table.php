<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_155557_create_seasons_table extends Migration
{
    public function up()
    {
        $this->createTable('seasons', [
            'seasonId' => Schema::TYPE_PK,
            'seasonName' => Schema::TYPE_STRING . '(45) NOT NULL'
        ]);
    }

    public function down()
    {
        $this->dropTable('seasons');
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
