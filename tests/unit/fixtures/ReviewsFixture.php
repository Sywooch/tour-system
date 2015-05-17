<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

class ReviewsFixture extends  ActiveFixture
{
    public $modelClass = 'app\models\Review';
    public $depends = ['tests\unit\fixtures\ReservationsFixture'];
}