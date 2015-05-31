<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

class AttendeesFixture extends  ActiveFixture
{
    public $modelClass = 'app\models\Attendee';
    public $depends = ['tests\unit\fixtures\ReservationsFixture'];
}