<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

class SettlementsFixture extends  ActiveFixture
{
    public $modelClass = 'app\models\Settlement';
    public $depends = ['tests\unit\fixtures\OffersFixture'];
}