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
				[['contractorShortName', 'contractorFullName', 'contractorStreet',
				  'contractorPostcode', 'contractorCity', 'contractorCountry', 'contractorNIP'],
				 'required', 'message' => 'To pole nie może być puste.'],
				[['contractorNIP'], 'integer', 'message' => 'Dozwolone znaki to cyfry.'],
				[['contractorShortName', 'contractorStreet','contractorCity', 'contractorCountry'], 'string', 'max' => 45, 'message' => "Za długa wartość. Maksymalna długość: 45 znaków."],
				[['contractorFullName'], 'string', 'max' => 255, 'message' => "Za długa wartość. Maksymalna długość: 255 znaków."],
				[['contractorPostcode'], 'string', 'min' =>6, 'message' => "W tym polu powinno być 6 znaków.", 'max' => 6, 'message' => "W tym polu powinno być 6 znaków."],
				['contractorShortName', 'unique', 'message' => 'Podana nazwa skrócona już istnieje w bazie.' ],
				['contractorNIP', 'unique', 'message' => 'Podana numer NIP już istnieje w bazie.' ]
		];
	}
	
	public function attributeLabels()
	{
		return [
				'contractorShortName' => 'Nazwa skrócona',
				'contractorFullName' => 'Nazwa pełna',
				'contractorStreet' => 'Adres',
				'contractorPostcode' => 'Kod pocztowy',
				'contractorCity' => 'Miejscowość',
				'contractorCountry' => 'Kraj',
				'contractorNIP' => 'Numer NIP'
		];
	}
}