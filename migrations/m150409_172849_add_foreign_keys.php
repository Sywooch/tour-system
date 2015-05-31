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
        $this->addForeignKey('customers_userId_fk_in_reservations', 'reservations', 'customers_userId', 'customers', 'customerId');
        $this->addForeignKey('offersId_fk_in_reservations', 'reservations', 'offers_offerId', 'offers', 'offerId');
        $this->addForeignKey('reservationId_fk_in_reviews', 'reviews', 'reservations_reservationId', 'reservations', 'reservationId');
        $this->addForeignKey('reservationId_fk_in_payments', 'payments', 'reservations_reservationId', 'reservations', 'reservationId');
        $this->addForeignKey('paymentMethodId_fk_in_payments', 'payments', 'paymentMethods_paymentMethodId', 'paymentMethods', 'paymentMethodId');
        $this->addForeignKey('reservationId_fk_in_attendees', 'attendees', 'reservations_reservationId', 'reservations', 'reservationId');
        $this->addForeignKey('reservationId_fk_in_customerInvoices', 'customerInvoices', 'reservations_reservationId', 'reservations', 'reservationId');
        $this->addForeignKey('offerId_fk_in_settlements', 'settlements', 'offers_offerId', 'offers', 'offerId');
        $this->addForeignKey('paymentMethodId_fk_in_customerInvoices', 'customerInvoices', 'paymentMethods_paymentMethodId', 'paymentMethods', 'paymentMethodId');
        $this->addForeignKey('offers_offerId_fk_in_costsBills', 'costsBills', 'offers_offerId', 'offers', 'offerId');
        $this->addForeignKey('contractorId_fk_in_costsBills', 'costsBills', 'contractors_contractorId', 'contractors', 'contractorId');
        $this->addForeignKey('countryId_fk_in_offers', 'offers', 'countries_countryId', 'countries', 'countryId');
        $this->addForeignKey('seasonId_fk_in_offers', 'offers', 'seasons_seasonId', 'seasons', 'seasonId');
        $this->addForeignKey('offers_offerId_fk_in_offerimages', 'offerimages', 'offers_offerId', 'offers', 'offerId');
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
        $this->dropForeignKey('reservationId_fk_in_customerInvoices', 'customerInvoices');
        $this->dropForeignKey('offerId_fk_in_settlements', 'settlements');
        $this->dropForeignKey('paymentMethodId_fk_in_customerInvoices', 'customerInvoices');
        $this->dropForeignKey('offers_offerId_fk_in_costsBills', 'costsBills');
        $this->dropForeignKey('contractorId_fk_in_costsBills', 'costsBills');
        $this->dropForeignKey('countryId_fk_in_offers', 'offers');
        $this->dropForeignKey('seasonId_fk_in_offers', 'offers');
        $this->dropForeignKey('offers_offerId_fk_in_offerimages', 'offerimages');
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
