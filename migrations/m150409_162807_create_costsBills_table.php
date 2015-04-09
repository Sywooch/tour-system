<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_162807_create_costsBills_table extends Migration
{
    public function up()
    {
        $this->createTable('costsBills', [
            'costsBillId' => Schema::TYPE_PK,
            'costsBillDate' => Schema::TYPE_DATE . ' NOT NULL',
            'costsBillNo' => Schema::TYPE_STRING . '(45) NOT NULL',
            'costsBillValue' => Schema::TYPE_STRING . '(45) NOT NULL',
            'costsBillDescription' => Schema::TYPE_STRING . '(45) NOT NULL',
            'settlements_offerId' => Schema::TYPE_INTEGER . ' NOT NULL',
            'contractors_contractorId' => Schema::TYPE_INTEGER . ' NOT NULL'
        ]);
    }

    public function down()
    {
        $this->dropTable('costsBills');
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
