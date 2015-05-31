<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
$faker->addProvider(new Faker\Provider\pl_PL\Person($faker));
return [
    'attendeeName' => $faker->firstName,
    'attendeeSurname' => $faker->lastName,
    'attendeeStreet' => $faker->streetName,
    'attendeeSPostCode' => $faker->postcode,
    'attendeeCity' => $faker->city,
    'attendeePESEL' => $faker->pesel,
    'attendeeBirthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'reservations_reservationId' => 1,
];