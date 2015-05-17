<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paymentmethods".
 *
 * @property integer $paymentMethodId
 * @property string $paymentMethodName
 *
 * @property Customerinvoices[] $customerinvoices
 * @property Payments[] $payments
 */
class PaymentMethod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paymentmethods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['paymentMethodName'], 'required'],
            [['paymentMethodName'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'paymentMethodId' => 'Payment Method ID',
            'paymentMethodName' => 'Payment Method Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerinvoices()
    {
        return $this->hasMany(Customerinvoices::className(), ['paymentMethods_paymentMethodId' => 'paymentMethodId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payments::className(), ['paymentMethods_paymentMethodId' => 'paymentMethodId']);
    }
}
