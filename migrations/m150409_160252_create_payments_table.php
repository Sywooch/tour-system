<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_160252_create_payments_table extends Migration
{
    public function up()
    {
        $this->createTable('payments', [
            'paymentId' => Schema::TYPE_PK,
            'paymentDate' => Schema::TYPE_DATE . ' NOT NULL',
            'paymentValue' => Schema::TYPE_INTEGER . ' NOT NULL',
            'paymentMethods_paymentMethodId' => Schema::TYPE_INTEGER . ' NOT NULL',
            'reservations_reservationId' => Schema::TYPE_INTEGER . ' NOT NULL'
        ]);
    }

    public function down()
    {
        $this->dropTable('payments');
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
