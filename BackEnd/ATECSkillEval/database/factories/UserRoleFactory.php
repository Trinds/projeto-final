<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User_role;
use Faker\Generator as Faker;

$factory->define(User_role::class, function (Faker $faker) {
    return [
        'role' => $faker->randomElement(['user', 'superuser']),
    ];
});
