<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'paymentDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'paymentValue' => $faker->numberBetween($min = 100, $max = 1000),
    'paymentMethods_paymentMethodId' => 1,
    'reservations_reservationId' => 1,
];