<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_155546_create_countries_table extends Migration
{
    public function up()
    {
        $this->createTable('countries', [
            'countryId' => Schema::TYPE_PK,
            'countryName' => Schema::TYPE_STRING . '(45) NOT NULL'
        ]);
    }

    public function down()
    {
        $this->dropTable('countries');
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
