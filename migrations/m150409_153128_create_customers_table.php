<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_153128_create_customers_table extends Migration
{
    public function up()
    {
        $this->createTable('customers', [
            'customerId' => Schema::TYPE_PK,
            'customerName' => Schema::TYPE_STRING . '(45) NOT NULL',
            'customerSurname' => Schema::TYPE_STRING . '(45) NOT NULL',
            'customerStreet' => Schema::TYPE_STRING . '(45) NOT NULL',
            'customerPostcode' => Schema::TYPE_STRING . '(6) NOT NULL',
            'customerCity' => Schema::TYPE_STRING . '(45) NOT NULL',
            'customerPESEL' => Schema::TYPE_BIGINT . ' NOT NULL',
            'customerPhone' => Schema::TYPE_STRING . '(13) NOT NULL',
            'customerBirthdate' => Schema::TYPE_DATE . ' NOT NULL',
            'user_userId' => Schema::TYPE_INTEGER
        ]);
    }

    public function down()
    {
        $this->dropTable('customers');
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
