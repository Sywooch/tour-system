<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

class CostsBillsFixture extends  ActiveFixture
{
    public $modelClass = 'app\models\CostsBill';
    public $depends = ['tests\unit\fixtures\SettlementsFixture', 'tests\unit\fixtures\ContractorsFixture'];
}