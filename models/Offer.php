<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "offers".
 *
 * @property integer $offerId
 * @property string $offerName
 * @property string $offerStartDate
 * @property string $offerEndDate
 * @property integer $offerPrice
 * @property string $offerDescription
 * @property string $offerAccommodation
 * @property string $offerBenefits
 * @property string $offerProgram
 * @property string $offerOptional
 * @property string $offerNote
 * @property string $offerPracticalData
 * @property integer $offerLastMinutePrice
 * @property integer $offerFirstMinutePrice
 * @property integer $offerIsFirstMinute
 * @property integer $offerIsLastMinute
 * @property integer $offerIsActive
 * @property integer $countries_countryId
 * @property integer $seasons_seasonId
 *
 * @property Country $Country
 * @property Season $Season
 */
class Offer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['offerName', 'offerStartDate', 'offerEndDate', 'offerPrice',
                'offerDescription', 'offerAccommodation', 'offerBenefits', 'offerProgram',
                'offerOptional', 'offerNote', 'offerPracticalData', 'offerIsFirstMinute',
                'offerIsLastMinute', 'offerIsActive', 'countries_countryId', 'seasons_seasonId'], 'required'],
            [['offerStartDate', 'offerEndDate'], 'safe'],
            [['offerPrice', 'offerLastMinutePrice', 'offerFirstMinutePrice', 'countries_countryId', 'seasons_seasonId'], 'integer'],
            [['offerIsFirstMinute', 'offerIsLastMinute', 'offerIsActive'], 'boolean'],
            [['offerDescription', 'offerAccommodation', 'offerBenefits', 'offerProgram', 'offerOptional', 'offerNote', 'offerPracticalData'], 'string'],
            [['offerName'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'offerName' => 'Nazwa oferty',
            'offerStartDate' => 'Data początku oferty',
            'offerEndDate' => 'Data konca oferty',
            'offerPrice' => 'Cena oferty',
            'offerDescription' => 'Opis oferty',
            'offerAccommodation' => 'Offer Accommodation',
            'offerBenefits' => 'Korzyści oferty',
            'offerProgram' => 'Programa oferty',
            'offerOptional' => 'Offer Optional',
            'offerNote' => 'Offer Note',
            'offerPracticalData' => 'Offer Practical Data',
            'offerLastMinutePrice' => 'Offer Last Minute Price',
            'offerFirstMinutePrice' => 'Offer First Minute Price',
            'offerIsFirstMinute' => 'Offer Is First Minute',
            'offerIsLastMinute' => 'Offer Is Last Minute',
            'offerIsActive' => 'Offer Is Active',
            'countries_countryId' => 'Nazwa kraju',
            'seasons_seasonId' => 'Nazwa sezonu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountriesCountry()
    {
        return $this->hasOne(Country::className(), ['countryId' => 'countries_countryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeasonsSeason()
    {
        return $this->hasOne(Season::className(), ['seasonId' => 'seasons_seasonId']);
    }
    
    public function getReservations()
    {
    	return $this->hasMany(Reservation::className(), ['offers_offerId' => 'offerId']);
    }
}
