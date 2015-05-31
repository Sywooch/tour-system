<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_172990_create_config_table extends Migration
{
    public function up()
    {
        $this->createTable('conifg', [
            'id' => Schema::TYPE_PK,
            'lastInvoiceNo' => Schema::TYPE_INTEGER,
        	'companyName' => Schema::TYPE_STRING,
        	'companyAddress' => Schema::TYPE_STRING,
        	'companyPostcode' => Schema::TYPE_STRING,
        	'companyCity' => Schema::TYPE_STRING,
        	'companyNIP' => Schema::TYPE_STRING
        ]);
    }

    public function down()
    {
        $this->dropTable('config');
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
