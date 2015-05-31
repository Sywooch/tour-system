<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

class OffersFixture extends  ActiveFixture
{
    public $modelClass = 'app\models\Offer';
    public $depends = ['tests\unit\fixtures\CountriesFixture', 'tests\unit\fixtures\SeasonsFixture'];
}