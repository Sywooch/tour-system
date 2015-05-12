<?php

namespace app\models;

use Yii;
use yii\validators\StringValidator;

class Group extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'groups';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
				[['groupName'], 'required', 'message' => 'Musi byæ podana nazwa grupy'],
				[['groupName'], 'string', 'min'=>3, 'max'=>45]
		];
	}
	public function attributeLabels()
	{
		return [
				'groupId' => 'ID Grupy',
				'groupName' => 'Nazwa grupy'
		];
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasMany(User::className(), ['groups_groupId' => 'groupId']);
	}
}