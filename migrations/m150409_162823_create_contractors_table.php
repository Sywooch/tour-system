<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_162823_create_contractors_table extends Migration
{
    public function up()
    {
        $this->createTable('contractors', [
            'contractorId' => Schema::TYPE_PK,
            'contractorShortName' => Schema::TYPE_STRING . '(45) NOT NULL UNIQUE',
            'contractorFullName' => Schema::TYPE_STRING . '(255) NOT NULL',
            'contractorStreet' => Schema::TYPE_STRING . '(45) NOT NULL',
            'contractorPostcode' => Schema::TYPE_STRING . '(45) NOT NULL',
            'contractorCity' => Schema::TYPE_STRING . '(45) NOT NULL',
            'contractorCountry' => Schema::TYPE_STRING . '(45) NOT NULL',
            'contractorNIP' => Schema::TYPE_BIGINT . ' NOT NULL UNIQUE'
        ]);
    }

    public function down()
    {
        $this->dropTable('contractors');
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
