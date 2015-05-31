<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'reservationDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'reservationInvoiced' => null,
    'reservationPricePerAtendee' => $faker->numberBetween($min = 10, $max = 100),
    'customers_userId' => 1,
    'agents_userId' => 1,
    'offers_offerId' => 1,
];