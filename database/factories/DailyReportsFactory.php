<?php

use Faker\Generator as Faker;

$factory->define(App\Models\DailyReport::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 50),
        'title' => $faker->realText(30, 2),
        'content'=>$faker->realText(50, 2),
        'reporting_time' => $faker->dateTime('now', date_default_timezone_get()),
        'created_at' => $faker->dateTime('now', date_default_timezone_get()),
    ];
});
