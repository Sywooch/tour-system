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
            [['reviewDescription'], 'required'],
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
            'reviewDate' => 'Data recenzji',
            'reviewDescription' => 'Recenzja',
            'reservations_reservationId' => 'Reservations Reservation ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservationsReservation()
    {
        return $this->hasOne(Reservation::className(), ['reservationId' => 'reservations_reservationId']);
    }
}
