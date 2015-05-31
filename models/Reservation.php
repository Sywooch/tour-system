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
				[['reservationPrepaid'], 'integer', 'message'=>"Niepoprawny format zaliczki"],
		];
	}

	public function attributeLabels()
	{
		return [
				'reservationDate' => 'Data rezerwacji',
				'reservationInvoiced' => 'Zafakturowane',
				'reservationPrepaid' => "Zaliczka",
				'reservationPricePerAtendee' => 'Cena za całą rezerwację'
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
	
	public function getAttendees()
	{
		return $this->hasMany(Attendee::className(), ['reservations_reservationId' => 'reservationId']);
	}
	
	public function getOffers()
	{
		return $this->hasOne(Offer::className(), ['offerId' => 'offers_offerId']);
	}
	
	public function getPayments(){
		return $this->hasMany(Payment::className(), ['reservations_reservationId' => 'reservationId']);
	}
	
	public function getPaymentsValue(){
		$total = 0;
		if($this->getPayments()->count() > 0)
			foreach($this->getPayments() as $payment)
				$total += $payment->paymentValue;
			
		return $total;
	}
	
}