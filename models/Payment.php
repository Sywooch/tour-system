<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property integer $paymentId
 * @property string $paymentDate
 * @property integer $paymentValue
 * @property integer $paymentMethods_paymentMethodId
 * @property integer $reservations_reservationId
 *
 * @property Paymentmethods $paymentMethodsPaymentMethod
 * @property Reservations $reservationsReservation
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['paymentDate', 'paymentValue', 'paymentMethods_paymentMethodId', 'reservations_reservationId'], 'required'],
            [['paymentDate'], 'safe'],
            [['paymentValue', 'paymentMethods_paymentMethodId', 'reservations_reservationId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'paymentId' => 'Payment ID',
            'paymentDate' => 'Payment Date',
            'paymentValue' => 'Payment Value',
            'paymentMethods_paymentMethodId' => 'Payment Methods Payment Method ID',
            'reservations_reservationId' => 'Reservations Reservation ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethodsPaymentMethod()
    {
        return $this->hasOne(Paymentmethods::className(), ['paymentMethodId' => 'paymentMethods_paymentMethodId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservationsReservation()
    {
        return $this->hasOne(Reservations::className(), ['reservationId' => 'reservations_reservationId']);
    }
}
