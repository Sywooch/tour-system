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
				[['reservationDate'], 'date',  'message' => "B³êdny format daty."],
				[['reservationInvoiced'], 'boolean'], 
				[['reservationPricePerAtendee'], 'float']
		];
	}

	public function attributeLabels()
	{
		return [
				'reservationDate' => 'Data rezerwacji',
				'reservationInvoiced' => 'Zafakturowane',
				'reservationPricePerAtendee' => 'Cena za ca³¹ rezerwacjê'
		];
	}
	
	public function getCustomers()
	{
		return $this->hasOne(Customers::className(), ['customers' => 'customers_userId']);
	}
	
	public function getAgents()
	{
		return $this->hasOne(Agents::className(), ['agents' => 'agents_userId']);
	}
	
	public function getOffers()
	{
		return $this->hasOne(Offers::className(), ['offers' => 'offers_offerId']);
	}
	
}