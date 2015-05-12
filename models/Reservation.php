<?php
namespace app\models;

use Yii;

class Reservation extends \yii\db\ActiveRecord{

	public static function tableName()
	{
		return 'reservations';
	}

	public function rules()
	{
		return [
				[['reservationDate'], 'date',  'message' => "B��dny format daty."],
				[['reservationInvoiced'], 'boolean'], 
				[['reservationPricePerAtendee'], 'integer']
		];
	}

	public function attributeLabels()
	{
		return [
				'reservationDate' => 'Data rezerwacji',
				'reservationInvoiced' => 'Zafakturowane',
				'reservationPricePerAtendee' => 'Cena za ca�� rezerwacj�'
		];
	}
	
	public function getCustomers()
	{
		return $this->hasOne(Customer::className(), ['customerId' => 'customers_userId']);
	}
	
	public function getAgents()
	{
		return $this->hasOne(Agent::className(), ['agentId' => 'agents_userId']);
	}
	
	public function getOffers()
	{
		return $this->hasOne(Offer::className(), ['offerId' => 'offers_offerId']);
	}
	
}