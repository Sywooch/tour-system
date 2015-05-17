<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
$faker->addProvider(new Faker\Provider\pl_PL\Person($faker));
return [
    'customerName' => $faker->firstName,
    'customerSurname' => $faker->lastName,
    'customerStreet' => $faker->streetName,
    'customerPostcode' => $faker->postcode,
    'customerCity' => $faker->city,
    'customerPESEL' => $faker->pesel,
    'customerPhone' => $faker->phoneNumber,
    'customerBirthDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'user_userId' => 1
];