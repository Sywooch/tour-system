<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customerinvoices".
 *
 * @property integer $customerInvoiceId
 * @property string $customerInvoiceNo
 * @property string $customerInvoiceDate
 * @property string $customerInvoiceDateOfSale
 * @property integer $attendees_attendeeId
 * @property integer $settlements_offers_offerId
 * @property integer $paymentMethods_paymentMethodId
 *
 * @property Attendees $attendeesAttendee
 * @property Paymentmethods $paymentMethodsPaymentMethod
 * @property Settlements $settlementsOffersOffer
 */
class CustomerInvoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customerinvoices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerInvoiceNo', 'customerInvoiceDate', 'paymentMethods_paymentMethodId'], 'required'],
            [['customerInvoiceDate', 'customerInvoiceDateOfSale', 'customerInvoicePaymentDate'], 'safe'],
            [['paymentMethods_paymentMethodId'], 'integer'],
            [['customerInvoiceNo'], 'string', 'max' => 45],
            [['customerInvoiceNo'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customerInvoiceId' => 'Customer Invoice ID',
            'customerInvoiceNo' => 'Customer Invoice No',
            'customerInvoiceDate' => 'Customer Invoice Date',
            'customerInvoiceDateOfSale' => 'Customer Invoice Date Of Sale',
            'attendees_attendeeId' => 'Attendees Attendee ID',
            'settlements_offers_offerId' => 'Settlements Offers Offer ID',
            'paymentMethods_paymentMethodId' => 'Payment Methods Payment Method ID',
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
