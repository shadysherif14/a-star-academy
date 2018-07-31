<?php

use Faker\Generator as Faker;

$factory->define(App\Instructor::class, function (Faker $faker) {

    $faker->addProvider(new \Bezhanov\Faker\Provider\Avatar($faker));

    return [
        
        'name' => $faker->name,
        'slug' => $faker->slug,
        'about' => $faker->realText($maxNbChars = 50),
        'avatar' => $faker->avatar
    ];
});
