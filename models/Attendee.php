<?php

namespace app\models;

use Yii;
use yii\validators\StringValidator;

class Attendee extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'attendees';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
				[['attendeeName', 'attendeeSurname', 'attendeeStreet','attendeeSPostcode','attendeeCity'],
				'required', 'message' => 'To pole nie może być puste.'],
				[['attendeePESEL', 'reservations_reservationId'], 'integer'],
				[['attendeeBirthdate'], 'date', 'message'=>"To pole nie może by puste."],
		];
	}
	public function attributeLabels()
	{
		return [
				'attendeeName' => 'Imie',
				'attendeeSurname' => 'Nazwisko',
				'attendeeStreet' => 'Ulica',
				'attendeeSPostcode' => 'Kod pocztowy',
				'attendeeCity' => 'Miasto',
				'attendeePESEL' => 'Pesel',
				'attendeeBirthdate' => 'Data urodzenia',
				'reservations_reservationId' => 'Id rezerwacji'
		];
	}
	
	public function getReservation()
	{
		return $this->hasOne(Customer::className(), ['reservationId' => 'reservations_reservationId']);
	}
	
	
}