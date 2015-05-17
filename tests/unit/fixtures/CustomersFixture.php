<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

class CustomersFixture extends  ActiveFixture
{
    public $modelClass = 'app\models\Customer';
    public $depends = ['tests\unit\fixtures\UserFixture'];
}