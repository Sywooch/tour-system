<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\base\Security;

/**
 * This is the model class for table "offerimages".
 *
 * @property integer $offerimageId
 * @property integer $offers_offerId
 * @property string $image_path
 *
 * @property Offers $offersOffer
 */
class OfferImage extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'offerimages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
  		];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffersOffer()
    {
        return $this->hasOne(Offer::className(), ['offerId' => 'offers_offerId']);
    }
}
