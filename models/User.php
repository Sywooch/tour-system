<?php

namespace app\models;

use Yii;
use yii\validators\StringValidator;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;


class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
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
					 'required', 'message' => 'To pole nie może być puste.'],
				[['userLogin'], 'string', 'min'=>4, 'message'=>"Nazwa użytkownika powinna mieć co najmniej cztery znaki", 'max'=>10, 'message'=>"Nazwa użytkownika powinna mieć nie więcej niż 10 znaków"],
				[['userPassword'], 'string', 'min'=>6, 'message'=>"Hasło powinno mieć przynajmniej sześć znaków", 'max'=>255, 'message'=>"Hasło zbyt długie"],
				[['userEmail'], 'email', 'message'=>"Niepoprawny adres e-mail"],
				[['userLogin'], 'unique', 'message'=>"Wybrany login jest już zajęty"]
		];
	}
	public function attributeLabels()
	{
		return [
				'userLogin' => 'Login',
				'userPassword' => 'Hasło',
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
	public static function findIdentity($id)
	{
		return static::findOne($id);
	}
	public static function findIdentityByAccessToken($token, $type = null)
	{
		return static::findOne(['accessToken' => $token]);
	}
	public static function findByUsername ($us)
	{
		return static::findOne(['userLogin' => $us]);
	}
	public function getId ()
	{
		return $this->getPrimaryKey();
	}
	public function getAuthKey ()
	{
		return $this->authKey;
	}
	public function validateAuthKey ($authKey)
	{
		return $this->getAuthKey() === $authKey;
	}
	/*public function validatePassword ($password)
	{
		return $this->userPassword === Yii::$app->getSecurity()->generatePasswordHash($password);
		//return $this->userPassword === sha1($password);
	}*/
	public function setPassword ($password)
	{
		$this->userPassword=Yii::$app->getSecurity()->generatePasswordHash($password);
	}
	public function generateAuthKey ()
	{
		$this->authKey=Yii::$app->getSecurity()->generateRandomKey();
	}
	public function isCustomer () 
	{
		return $this->groups_groupId === 3;
	}
	public function isAgent ()
	{
		return $this->groups_groupId === 2;
	}
	public function isPersonnel ()
	{
		return $this->groups_groupId === 1;
	}
}