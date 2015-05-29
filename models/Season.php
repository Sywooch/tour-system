<?php

namespace app\models;

use Yii;

class Season extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seasons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seasonName'], 'required'],
            [['seasonName'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'seasonId' => 'Season ID',
            'seasonName' => 'Season Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffers()
    {
        return $this->hasMany(Offer::className(), ['seasons_seasonId' => 'seasonId']);
    }
}
