<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'offerName' => $faker->sentence($nbWords = 6),
    'offerStartDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'offerEndDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'offerPrice' => $faker->numberBetween($min = 100, $max = 1000),
    'offerDescription' => $faker->sentence($nbWords = 10),
    'offerAccommodation' => $faker->sentence($nbWords = 12),
    'offerBenefits' => $faker->words($nb = 5),
    'offerProgram' => $faker->text(),
    'offerOptional' => $faker->paragraph($nbSentences = 3),
    'offerNote' => $faker->sentence($nbWords = 6),
    'offerPracticalData' => $faker->paragraph($nbSentences = 3),
    'offerLastMinutePrice' => $faker->numberBetween($min = 50, $max = 700),
    'offerFirstMinutePrice' => $faker->numberBetween($min = 50, $max = 700),
    'offerIsFirstMinute' => true,
    'offerIsLastMinute' => true,
    'offerIsActive' => true,
    'countries_countryId' => 1,
    'seasons_seasonId' => 1,
];