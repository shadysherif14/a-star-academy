<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'level_id' => function() {
            return factory(App\Level::class)->create()->id;
        },
        'name' => $faker->word,
        'slug' => $faker->slug, 
        'description' => $faker->realText(250)
    ];
});