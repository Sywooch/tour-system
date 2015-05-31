<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'reviewDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'reviewDescription' => $faker->sentence($nbWords = 6),
    'reservations_reservationId' => 1,
];