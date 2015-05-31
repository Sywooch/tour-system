<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

class PaymentsFixture extends  ActiveFixture
{
    public $modelClass = 'app\models\Payment';
    public $depends = ['tests\unit\fixtures\PaymentMethodsFixture', 'tests\unit\fixtures\ReservationsFixture'];
}