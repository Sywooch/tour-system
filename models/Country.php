<?php

namespace app\models;

use Yii;

class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryName'], 'required'],
            [['countryName'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'countryId' => 'Country ID',
            'countryName' => 'Country Name',
        ];
    }

    public function getOffers()
    {
        return $this->hasMany(Offer::className(), ['countries_countryId' => 'countryId']);
    }
}
