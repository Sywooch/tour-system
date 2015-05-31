<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'costsBillDate' => $faker->dateTimeThisYear($max = 'now'),
    'costsBillNo' => $faker->bothify('??????'),
    'costsBillValue' => $faker->bothify('??????'),
    'costsBillDescription' => $faker->text(),
    'settlements_offerId' => 1,
    'contractors_contractorId' => 1,
];