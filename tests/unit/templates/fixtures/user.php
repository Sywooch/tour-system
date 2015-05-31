<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'userLogin' => $faker->userName,
    'userPassword' => Yii::$app->getSecurity()->generatePasswordHash('qwerty'),
    'userEmail' => $faker->email,
    'groups_groupId' => 3,
    'authKey' => Yii::$app->getSecurity()->generateRandomString(),
    'accessToken' => '',
];