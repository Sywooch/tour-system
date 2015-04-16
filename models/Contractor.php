<?php
namespace app\models;

use Yii;

class Contractor extends \yii\db\ActiveRecord{
	
	public static function tableName()
	{
		return 'contractors';
	}
	
	public function rules()
	{
		return [
				[['ContractorShortName', 'ContractorFullName', 'ContractorStreet',
				  'ContractorPostcode', 'ContractorCity', 'ContractorCountry', 'ContractorNIP'], 
				 'required', 'message' => 'To pole nie może być puste.'],
				[['ContractorNIP'], 'integer', 'message' => 'Dozwolone znaki to cyfry.'],
				[['ContractorShortName', 'ContractorStreet','ContractorCity', 'ContractorCountry'], 'string', 'max' => 45, 'message' => "Za długa wartość. Maksymalna długość: 45 znaków."],
				[['ContractorFullName'], 'string', 'max' => 255, 'message' => "Za długa wartość. Maksymalna długość: 255 znaków."],
				[['ContractorPostcode'], 'string', 'min' =>6, 'message' => "W tym polu powinno być 6 znaków.", 'max' => 6, 'message' => "W tym polu powinno być 6 znaków."]
		];
	}
	
	public function attributeLabels()
	{
		return [
				'ContractorShortName' => 'Nazwa skrócona',
				'ContractorFullName' => 'Nazwa pełna',
				'ContractorStreet' => 'Adres',
				'ContractorPostcode' => 'Kod pocztowy',
				'ContractorCity' => 'Miejscowość',
				'ContractorCountry' => 'Kraj',
				'ContractorNIP' => 'Numer NIP'
		];
	}
}