<?php
namespace app\models;

use Yii;

class Settlement extends \yii\db\ActiveRecord{
	
	public static function tableName()
	{
		return 'settlements';
	}
	
	public function rules()
	{
		return [
				[['settlementNo', 'settlementDate'],
				 'required', 'message' => 'To pole nie może być puste.'],
		       ];
	}
	
	public function attributeLabels()
	{
		return [
				'settlementNo' => 'Numer rozliczenia',
				'settlementDate' => 'Data sporządzenia',
				'settlementTotalIncome' => 'Przychód razem',
				'settlementCosts' => 'Koszty razem',
				'settlementVAT' => 'Podatek VAT'
		];
	}
	
	public function getOffer(){
		return $this->hasOne(Offer::className(), ['offerId' => 'offers_offerId']);
	}
	
	public function getMargin(){
		$margin = $this->settlementTotalIncome - $this->settlementCosts;
		if ($margin < 0) $margin = 0;
		
		return $margin;
	}
}