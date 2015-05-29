<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_162635_create_settlements_table extends Migration
{
    public function up()
    {
        $this->createTable('settlements', [
            'settlementId' => Schema::TYPE_PK,	
            'offers_offerId' => Schema::TYPE_INTEGER . ' NOT NULL',
            'settlementNo' => Schema::TYPE_STRING . '(45) NOT NULL',
            'settlementTotalIncome' => Schema::TYPE_INTEGER  . ' NOT NULL',
            'settlementVAT' => Schema::TYPE_INTEGER  . ' NOT NULL',
            'settlementCosts' => Schema::TYPE_INTEGER  . ' NOT NULL',
            'settlementDate' => Schema::TYPE_DATE  . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('settlements');
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
