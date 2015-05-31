<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

class ReservationsFixture extends  ActiveFixture
{
    public $modelClass = 'app\models\Reservation';
    public $depends = ['tests\unit\fixtures\CustomersFixture', 'tests\unit\fixtures\AgentsFixture', 'tests\unit\fixtures\OffersFixture'];
}