<?php

use Faker\Generator as Faker;

$factory->define(App\Instructor::class, function (Faker $faker) {

    return [
        
        'name' => $faker->name,
        'slug' => $faker->slug,
        'about' => $faker->realText($maxNbChars = 50),
    ];
});
