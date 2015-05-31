<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'customerinvoiceNo' => $faker->bothify('??????'),
    'customerinvoiceDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'customerinvoiceDateOfSale' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'attendees_attendeeId' => 1,
    'settlements_offers_offerId' => 1,
    'paymentMethods_paymentMethodId' => 1,
];