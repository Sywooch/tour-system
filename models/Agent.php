<?php

namespace app\models;

use Yii;
use yii\validators\StringValidator;

class Agent extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'agents';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
				[['agentName', 'agentSurname'],
					 'required', 'message' => 'To pole nie może być puste.'],
				[['agentName', 'agentSurname'], 'string', 'min'=>2, 'max'=>100]
		];
	}
	public function attributeLabels()
	{
		return [
				'agentName' => 'Imię',
				'agentSurname' => 'Nazwisko',
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
		return $this->hasOne(Agent::className(), ['agents_agentId' => 'agentId']);
	}
}