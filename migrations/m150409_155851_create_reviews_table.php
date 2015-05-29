<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_155851_create_reviews_table extends Migration
{
    public function up()
    {
        $this->createTable('reviews', [
            'reviewId' => Schema::TYPE_PK,
            'reviewDate' => Schema::TYPE_DATE . ' NOT NULL',
            'reviewDescription' => Schema::TYPE_STRING . '(255) NOT NULL',
            'reservations_reservationId' => Schema::TYPE_INTEGER . ' NOT NULL'
        ]);
    }

    public function down()
    {
        $this->dropTable('reviews');
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
