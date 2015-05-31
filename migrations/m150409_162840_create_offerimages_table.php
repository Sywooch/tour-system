<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_162840_create_offerimages_table extends Migration
{
    public function up()
    {
        $this->createTable('offerimages', [
            'offerimageId' => Schema::TYPE_PK,
            'offers_offerId' => Schema::TYPE_INTEGER . ' NOT NULL',
            'image_path' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('offerimages');
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
