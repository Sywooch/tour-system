<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property integer $reviewId
 * @property string $reviewDate
 * @property string $reviewDescription
 * @property integer $reservations_reservationId
 *
 * @property Reservations $reservationsReservation
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reviewDate', 'reviewDescription', 'reservations_reservationId'], 'required'],
            [['reviewDate'], 'safe'],
            [['reservations_reservationId'], 'integer'],
            [['reviewDescription'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reviewId' => 'Review ID',
            'reviewDate' => 'Review Date',
            'reviewDescription' => 'Review Description',
            'reservations_reservationId' => 'Reservations Reservation ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservationsReservation()
    {
        return $this->hasOne(Reservations::className(), ['reservationId' => 'reservations_reservationId']);
    }
}
