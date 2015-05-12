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
					 'required', 'message' => 'To pole nie mo�e by� puste.'],
				[['attendeePESEL'],'required', 'integer', 'min'=>11, 'message'=>"za ma�o cyfr.",'max'=>11, 'message'=>"Za du�o cyfr."],
				[['attendeeBirthdate'],'required', 'date', 'message'=>"To pole nie mo�e by� puste."],
				[['reservations_reservationId'],'required', 'integer'],
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
		return $this->hasOne(Customers::className(), ['reservations' => 'reservations_reservationId']);
	}
	
	
}