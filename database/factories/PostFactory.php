<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(
    App\Post::class, function (Faker $faker) {
        return [
        'post_type' => $faker->randomElement(['stage','formation']),
        'title' => $faker->sentence(),
        'description' => $faker->paragraph(),
        'started' => Carbon::now()->addDay(rand(1, 21))->format('Y-m-d H:i'),
        'ended' => Carbon::now()->addDay(rand(100, 210))->format('Y-m-d H:i'),
        'price' => $faker->randomFloat(2, 3000, 7000),
        'student_max' => $faker->numberBetween($min = 7, $max = 25),
        ];
    }
);
