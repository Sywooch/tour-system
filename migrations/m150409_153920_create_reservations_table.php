<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_153920_create_reservations_table extends Migration
{
    public function up()
    {
        $this->createTable('reservations', [
            'reservationId' => Schema::TYPE_PK,
            'reservationDate' => Schema::TYPE_DATE . ' NOT NULL',
            'reservationInvoiced' => Schema::TYPE_BOOLEAN,
            'reservationPricePerAtendee' => Schema::TYPE_INTEGER . ' NOT NULL',
            'customers_userId' => Schema::TYPE_INTEGER,
            'agents_userId' => Schema::TYPE_INTEGER,
            'offers_offerId' => Schema::TYPE_INTEGER . ' NOT NULL',
        	'reservationPrepaid'=> Schema::TYPE_INTEGER
        ]);
    }

    public function down() 	
    {
        $this->dropTable('reservations');
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
