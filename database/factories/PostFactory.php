<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(
    App\Post::class, function (Faker $faker) {
        
        $year = 2018;
        $month = rand(2, 12);
        $day = rand(1, 28);
        $hour = rand(7, 22);
        $minute = rand(0, 60);
        $second = rand(0, 60);
        
        $date = Carbon::create($year, $month, $day, $hour, $minute, $second);
        
        return [
        'description' => $faker->paragraph(6),
        'post_type' => $faker->randomElement(['stage', 'formation']),
        'price' => $faker->randomFloat(0, 3000, 7000),
        'title' => $faker->sentence(3),
        'started' => $date->format('Y-m-d H:i:s'),
        'ended' => $date->addDays(rand(30, 365))
            ->addSeconds(rand(43200, 86400))->format('Y-m-d H:i:s'),
        'student_max' => $faker->numberBetween($min = 5, $max = 25),
        ];
    }
);
