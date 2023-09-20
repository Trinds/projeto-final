<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' =>$faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $faker->password, 
        'image' => $faker->imageUrl(640, 480),
        'user_role_id' => rand(1, 2),

    ];
});
