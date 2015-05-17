<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

class CustomerInvoicesFixture extends  ActiveFixture
{
    public $modelClass = 'app\models\CustomerInvoice';
    public $depends = ['tests\unit\fixtures\AttendeesFixture', 'tests\unit\fixtures\SettlementsFixture', 'tests\unit\fixtures\PaymentMethodsFixture'];
}