<?php

namespace app\models;

use Yii;

class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conifg';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'lastInvoiceNo' => 'Numer ostatniej faktury',
            'companyName' => 'Sprzedawca',
            'companyAddres' => 'Adres sprzedawcy',
            'companyPostcode' => 'Kod pocztowy sprzedawcy',
            'companyCity' => 'Miasto sprzedawcy',
            'companyNIP' => 'NIP sprzedawcy',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttendeesAttendee()
    {
        return $this->hasOne(Attendees::className(), ['attendeeId' => 'attendees_attendeeId']);
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
    public function getSettlementsOffersOffer()
    {
        return $this->hasOne(Settlements::className(), ['offers_offerId' => 'settlements_offers_offerId']);
    }
}
