<?php

use Faker\Generator as Faker;

$factory->define(App\Models\DailyReport::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 50),
        'title' => $faker->realText($maxNbChars = 30, $indexSize = 2),
        'content'=>$faker->realText($maxNbChars = 50, $indexSize = 2),
        'reporting_time' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});
