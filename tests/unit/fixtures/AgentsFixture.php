<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

class AgentsFixture extends  ActiveFixture
{
    public $modelClass = 'app\models\Agent';
    public $depends = ['tests\unit\fixtures\UserFixture'];
}