<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Test_type;
use Faker\Generator as Faker;

$factory->define(Test_type::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement(['psiquico', 'tecnico']),
    ];
});
