<?php

namespace app\models;

use Yii;
use yii\validators\StringValidator;

class Users extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'user';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
				[['userLogin', 'userPassword', 'userEmail'],
					 'required', 'message' => 'To pole nie mo¿e byæ puste.'],
				[['userLogin'], 'string', 'min'=>4, 'message'=>"Nazwa u¿ytkownika powinna mieæ co najmniej cztery znaki", 'max'=>10, 'message'=>"Nazwa u¿ytkownika powinna mieæ nie wiêcej ni¿ 10 znaków"],
				[['userPassword'], 'string', 'min'=>6, 'message'=>"Has³o powinno mieæ przynajmniej szeœæ znaków", 'max'=>255, 'message'=>"Has³o zbyt d³ugie"],
				[['userEmail'], 'email'/*, 'message'=>"Niepoprawny adres e-mail"*/],
				[['userLogin'], 'unique'/*, 'message'=>"Wybrany login jest ju¿ zajêty"*/]
		];
	}
	public function attributeLabels()
	{
		return [
				'userLogin' => 'Login',
				'userPassword' => 'Has³o',
				'userEmail' => 'E-mail',
				'userId' => 'User ID',
				'groups_groupId' => 'Groups Groups ID'
		];
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getGroups()
	{
		return $this->hasOne(Group::className(), ['groupId' => 'groups_groupId']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCustomer()
	{
		return $this->hasOne(Customer::className(), ['user_userId' => 'userId']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAgent()
	{
		return $this->hasOne(Agent::className(), ['user_userId' => 'userId']);
	}
}