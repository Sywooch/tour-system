<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_154610_create_offers_table extends Migration
{
    public function up()
    {
        $this->createTable('offers', [
            'offerId' => Schema::TYPE_PK,
            'offerName' => Schema::TYPE_STRING . '(45) NOT NULL',
            'offerStartDate' => Schema::TYPE_DATE . ' NOT NULL',
            'offerEndDate' => Schema::TYPE_DATE . ' NOT NULL',
            'offerPrice' => Schema::TYPE_INTEGER . ' NOT NULL',
            'offerDescription' => Schema::TYPE_TEXT . ' NOT NULL',
            'offerAccommodation' => Schema::TYPE_TEXT . ' NOT NULL',
            'offerBenefits' => Schema::TYPE_TEXT . ' NOT NULL',
            'offerProgram' => Schema::TYPE_TEXT . ' NOT NULL',
            'offerOptional' => Schema::TYPE_TEXT . ' NOT NULL',
            'offerNote' => Schema::TYPE_TEXT . ' NOT NULL',
            'offerPracticalData' => Schema::TYPE_TEXT . ' NOT NULL',
            'offerLastMinutePrice' => Schema::TYPE_INTEGER,
            'offerFirstMinutePrice' => Schema::TYPE_INTEGER,
            'offerIsFirstMinute' => Schema::TYPE_BOOLEAN . ' NOT NULL',
            'offerIsLastMinute' => Schema::TYPE_BOOLEAN . ' NOT NULL',
            'offerIsActive' => Schema::TYPE_BOOLEAN . ' NOT NULL',
            'countries_countryId' => Schema::TYPE_INTEGER . ' NOT NULL',
            'seasons_seasonId' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('offers');
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
