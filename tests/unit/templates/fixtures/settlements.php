<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'settlementNo' => $faker->bothify('??????'),
    'settlementTotalIncome' => $faker->numberBetween($min = 1000, $max = 9000),
    'settlementDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'settlementVAT' => $faker->numberBetween($min = 1000, $max = 9000),
    'settlementCosts' => $faker->numberBetween($min = 1000, $max = 9000),
    'offers_offerId' => 1,
];