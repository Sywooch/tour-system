<?php

namespace app\models;

use Yii;
use yii\validators\StringValidator;

class Customer extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'customers';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
				[['customerBirthdate', 'customerCity', 'customerName', 'customerPESEL', 'customerPhone', 'customerPostcode', 'customerStreet', 'customerSurname'],
					 'required', 'message' => 'To pole nie może być puste.'],
				[['customerBirthdate'], 'safe', 'message'=>"Niepoprawny format daty"],
				[['customerCity', 'customerName', 'customerStreet', 'customerSurname'], 'string', 'min'=>2, 'max'=>100],
				[['customerPESEL'], 'integer'/*, 'max'=>11, 'min'=>11*/],
				[['customerPhone'], 'integer'/*, 'min'=>9, 'message'=>"Numer telefonu jest za któtki", 'max'=>9, 'message'=>"Numer telefonu jest za długi"*/],
				[['customerPostcode'], 'string', 'min'=>6, 'message'=>"Niepoprawny kod pocztowy", 'max'=>6, 'message'=>"Niepoprawny kod pocztowy"]
		];
	}
	public function attributeLabels()
	{
		return [
				'customerId' => 'ID Klienta',
				'customerBirthdate' => 'Data urodzenia',
				'customerCity' => 'Miejsce zamieszkania',
				'customerName' => 'Imię',
				'customerPESEL' => 'Numer PESEL',
				'customerPhone' => 'Numer telefonu',
				'customerPostcode' => 'Kod pocztowy',
				'customerStreet' => 'Adres zamieszkania',
				'customerSurname' => 'Nazwisko',
				'user_userId' => 'User ID',
		];
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(User::className(), ['userId' => 'user_userId']);
	}
	
	public function getReservations()
	{
		return $this->hasOne(Customer::className(), ['customers_userId' => 'customerId']);
	}
	public function isUser () {
		if ($this->user_userId===NULL) {
			return false;
		} else {
			return true;
		}
	}
}