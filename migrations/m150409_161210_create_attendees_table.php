<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_161210_create_attendees_table extends Migration
{
    public function up()
    {
        $this->createTable('attendees', [
            'attendeeId' => Schema::TYPE_PK,
            'attendeeName' => Schema::TYPE_STRING . '(45) NOT NULL',
            'attendeeSurname' => Schema::TYPE_STRING . '(45) NOT NULL',
            'attendeeStreet' => Schema::TYPE_STRING . '(45) NOT NULL',
            'attendeeSPostcode' => Schema::TYPE_STRING . '(6) NOT NULL',
            'attendeeCity' => Schema::TYPE_STRING . '(45) NOT NULL',
            'attendeePESEL' => Schema::TYPE_BIGINT . ' NOT NULL',
            'attendeeBirthdate' => Schema::TYPE_DATE . ' NOT NULL',
            'reservations_reservationId' => Schema::TYPE_INTEGER . ' NOT NULL'
        ]);
    }

    public function down()
    {
        $this->dropTable('attendees');
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
