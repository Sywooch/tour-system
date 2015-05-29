<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "offerimages".
 *
 * @property integer $offerimageId
 * @property integer $offers_offerId
 * @property string $image_path
 *
 * @property Offers $offersOffer
 */
class Offerimage extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $image_file;

    /**
     * @inheritdoc
     */
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
            [['offers_offerId', 'image_path'], 'required'],
            [['offers_offerId'], 'integer'],
            [['image_file'], 'file'],
            [['image_path'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'offerimageId' => 'Offerimage ID',
            'offers_offerId' => 'Offers Offer ID',
            'image_path' => 'Image',
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
