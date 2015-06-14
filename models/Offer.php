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
            'offerStartDate' => 'Data wyjazdu',
            'offerEndDate' => 'Data powrotu',
            'offerPrice' => 'Cena',
            'offerDescription' => 'Opis oferty',
            'offerAccommodation' => 'Miejsce zakwaterowania',
            'offerBenefits' => 'Cena zawiera',
            'offerProgram' => 'Program oferty',
            'offerOptional' => 'Porogram fakultatywny',
            'offerNote' => 'Uwagi',
            'offerPracticalData' => 'Informacje praktyczny',
            'offerLastMinutePrice' => 'Cena Last Minute',
            'offerFirstMinutePrice' => 'Cena First Minute',
            'offerIsFirstMinute' => 'First Minute',
            'offerIsLastMinute' => 'Last Minute',
            'offerIsActive' => 'Aktywna',
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
    
    
    public function getTotalIncome(){
    	$reservations = $this->getReservations()->all();
    	$totalIncome = 0;
    	 
    	foreach($reservations as $reservation){
    		$totalIncome += $reservation->reservationPricePerAtendee;
    	}
    	 
    	return $totalIncome;
    }
    
    public function getCostsBills(){
    	return $this->hasMany(CostsBill::className(), ['offers_offerId' => 'offerId']);
    }
    
    public function getImages()
    {
    	return $this->hasMany(OfferImage::className(), ['offers_offerId' => 'offerId']);
    }
    
    public function getPrice(){
    	if($this->offerIsFirstMinute == 1) return $this->offerFirstMinutePrice;
    	elseif($this->offerIsLastMinute == 1) return $this->offerLastMinutePrice;
    	else return $this->offerPrice;
    }
    
    public function getSettlement()
    {
    	return $this->hasOne(Settlement::className(), ['offers_offerId' => 'offerId']);
    }
    
    public function countAttendees()
    {
    	$count = 0;
    	foreach($this->getReservations()->all() as $reservation)
    		$count += $reservation->getAttendees()->count();
    	
    	return $count;
    }
}
