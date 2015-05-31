<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
$faker->addProvider(new Faker\Provider\pl_PL\Person($faker));
return [
    'contractorShortName' => $faker->userName,
    'contractorFullName' => $faker->firstName,
    'contractorStreet' => $faker->streetName,
    'contractorPostcode' => $faker->postcode,
    'contractorCity' => $faker->city,
    'contractorCountry' => $faker->country,
    'contractorNIP' => $faker->taxpayerIdentificationNumber,
];