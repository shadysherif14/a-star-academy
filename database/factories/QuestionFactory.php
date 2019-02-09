<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence($nbWords = 10, $variableNbWords = true),
    ];
});
