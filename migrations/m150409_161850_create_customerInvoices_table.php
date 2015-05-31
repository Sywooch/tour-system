<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_161850_create_customerInvoices_table extends Migration
{
    public function up()
    {
        $this->createTable('customerInvoices', [
            'customerInvoiceId' => Schema::TYPE_PK,
            'customerInvoiceNo' => Schema::TYPE_STRING . '(45) NOT NULL UNIQUE',
            'customerInvoiceDate' => Schema::TYPE_DATE . ' NOT NULL',
            'customerInvoiceDateOfSale' => Schema::TYPE_DATE . ' NOT NULL',
        	'customerInvoicePaymentDate' => Schema::TYPE_DATE . ' NOT NULL',
            'reservations_reservationId' => Schema::TYPE_INTEGER . ' NOT NULL',
            'paymentMethods_paymentMethodId' => Schema::TYPE_INTEGER . ' NOT NULL'
        ]);
    }

    public function down()
    {
        $this->dropTable('customerInvoices');
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
