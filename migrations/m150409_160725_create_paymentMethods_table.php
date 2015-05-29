<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_160725_create_paymentMethods_table extends Migration
{
    public function up()
    {
        $this->createTable('paymentMethods', [
            'paymentMethodId' => Schema::TYPE_PK,
            'paymentMethodName' => Schema::TYPE_STRING . '(45) NOT NULL'
        ]);
    }

    public function down()
    {
        $this->dropTable('paymentMethods');
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
