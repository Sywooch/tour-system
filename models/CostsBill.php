<?php
namespace app\models;

use Yii;

class CostsBill extends \yii\db\ActiveRecord{
	
	public static function tableName()
	{
		return 'costsBills';
	}
	
	public function rules()
	{
		return [
				[['settlements_offerId', 'contractors_contractorId', 'costsBillDate', 'costsBillNo', 'costsBillValue', 'costsBillDescription'],
				 'required', 'message' => 'To pole nie może być puste.'],
				[['settlements_offerId', 'contractors_contractorId'], 'integer', 'message' => 'To pole musi wskazywać na klucz w bazie danych.'],
				[['costsBillNo', 'costsBillValue', 'costsBillDescription'], 'string', 'max' => 45, 'message' => "Za długa wartość. Maksymalna długość: 45 znaków."],
		       ];
	}
	
	public function attributeLabels()
	{
		return [
				'settlements_offerId' => 'Dotyczy oferty',
				'contractors_contractorId' => 'Nazwa skrócona kontrahenta',
				'costsBillDate' => 'Data wystawienia',
				'costsBillNo' => 'Numer dokumentu',
				'costsBillValue' => 'Wartość brutto',
				'costsBillDescription' => 'Opis zdarzenia'
		];
	}
	
	public function getSettlement(){
		return $this->hasOne(Settlement::className(), ['offers_offerId' => 'settlements_offerId']);
	}
	
	public function getContractor(){
		return $this->hasOne(Contractor::className(), ['contractorId' => 'contractors_contractorId']);
	}
}