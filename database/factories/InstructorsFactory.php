<?php

use Faker\Generator as Faker;

$factory->define(App\Instructor::class, function (Faker $faker) {

    $name = $faker->name;

    $username = str_replace(' ', '', $name);

    $about = $faker->realText(250);

    $email = $faker->unique()->safeEmail;

    $password = bcrypt('secret');

    $phone = $faker->phoneNumber;

    $accounts['facebook'] = 'https://www.facebook.com/shadysherifsayed';

    $accounts['instagram'] = 'https://www.instagram.com/shadysherifsayed';

    return compact('name', 'slug', 'about', 'email', 'password', 'phone', 'accounts');

});
