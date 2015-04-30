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
					 'required', 'message' => 'To pole nie mo�e by� puste.'],
				[['userLogin'], 'string', 'min'=>4, 'message'=>"Nazwa u�ytkownika powinna mie� co najmniej cztery znaki", 'max'=>10, 'message'=>"Nazwa u�ytkownika powinna mie� nie wi�cej ni� 10 znak�w"],
				[['userPassword'], 'string', 'min'=>6, 'message'=>"Has�o powinno mie� przynajmniej sze�� znak�w", 'max'=>255, 'message'=>"Has�o zbyt d�ugie"],
				[['userEmail'], 'email'/*, 'message'=>"Niepoprawny adres e-mail"*/],
				[['userLogin'], 'unique'/*, 'message'=>"Wybrany login jest ju� zaj�ty"*/]
		];
	}
	public function attributeLabels()
	{
		return [
				'userLogin' => 'Login',
				'userPassword' => 'Has�o',
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