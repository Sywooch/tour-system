<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_172849_add_foreign_keys extends Migration
{
    public function up()
    {
        $this->addForeignKey('groupId_fk_in_user', 'user', 'groups_groupId', 'groups', 'groupId');
        $this->addForeignKey('userId_fk_in_agents', 'agents', 'user_userId', 'user', 'userId');
        $this->addForeignKey('userId_fk_in_customers', 'customers', 'user_userId', 'user', 'userId');
        $this->addForeignKey('agents_userId_fk_in_reservations', 'reservations', 'agents_userId', 'agents', 'user_userId');
        $this->addForeignKey('customers_userId_fk_in_reservations', 'reservations', 'customers_userId', 'customers', 'user_userId');
        $this->addForeignKey('offersId_fk_in_reservations', 'reservations', 'offers_offerId', 'offers', 'offerId');
        $this->addForeignKey('reservationId_fk_in_reviews', 'reviews', 'reservations_reservationId', 'reservations', 'reservationId');
        $this->addForeignKey('reservationId_fk_in_payments', 'payments', 'reservations_reservationId', 'reservations', 'reservationId');
        $this->addForeignKey('paymentMethodId_fk_in_payments', 'payments', 'paymentMethods_paymentMethodId', 'paymentMethods', 'paymentMethodId');
        $this->addForeignKey('reservationId_fk_in_attendees', 'attendees', 'reservations_reservationId', 'reservations', 'reservationId');
        $this->addForeignKey('attendeeId_fk_in_customerInvoices', 'customerInvoices', 'attendees_attendeeId', 'attendees', 'attendeeId');
        $this->addForeignKey('offerId_fk_in_settlements', 'settlements', 'offers_offerId', 'offers', 'offerId');
        $this->addForeignKey('settlements_offerId_fk_in_customerInvoices', 'customerInvoices', 'settlements_offers_offerId', 'settlements', 'offers_offerId');
        $this->addForeignKey('paymentMethodId_fk_in_customerInvoices', 'customerInvoices', 'paymentMethods_paymentMethodId', 'paymentMethods', 'paymentMethodId');
        $this->addForeignKey('settlements_offerId_fk_in_costsBills', 'costsBills', 'settlements_offerId', 'settlements', 'offers_offerId');
        $this->addForeignKey('contractorId_fk_in_costsBills', 'costsBills', 'contractors_contractorId', 'contractors', 'contractorId');
        $this->addForeignKey('countryId_fk_in_offers', 'offers', 'countries_countryId', 'countries', 'countryId');
        $this->addForeignKey('seasonId_fk_in_offers', 'offers', 'seasons_seasonId', 'seasons', 'seasonId');
    }

    public function down()
    {
        $this->dropForeignKey('groupId_fk_in_user', 'user');
        $this->dropForeignKey('userId_fk_in_agents', 'agents');
        $this->dropForeignKey('userId_fk_in_customers', 'customers');
        $this->dropForeignKey('agents_userId_fk_in_reservations', 'reservations');
        $this->dropForeignKey('customers_userId_fk_in_reservations', 'reservations');
        $this->dropForeignKey('offersId_fk_in_reservations', 'reservations');
        $this->dropForeignKey('reservationId_fk_in_reviews', 'reviews');
        $this->dropForeignKey('reservationId_fk_in_payments', 'payments');
        $this->dropForeignKey('paymentMethodId_fk_in_payments', 'payments');
        $this->dropForeignKey('reservationId_fk_in_attendees', 'attendees');
        $this->dropForeignKey('attendeeId_fk_in_customerInvoices', 'customerInvoices');
        $this->dropForeignKey('offerId_fk_in_settlements', 'settlements');
        $this->dropForeignKey('settlements_offerId_fk_in_customerInvoices', 'customerInvoices');
        $this->dropForeignKey('paymentMethodId_fk_in_customerInvoices', 'customerInvoices');
        $this->dropForeignKey('settlements_offerId_fk_in_costsBills', 'costsBills');
        $this->dropForeignKey('contractorId_fk_in_costsBills', 'costsBills');
        $this->dropForeignKey('countryId_fk_in_offers', 'offers');
        $this->dropForeignKey('seasonId_fk_in_offers', 'offers');
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
