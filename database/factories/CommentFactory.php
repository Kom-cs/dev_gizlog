<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 50),
        'question_id' => $faker->numberBetween(1, 50),
        'comment' => $faker->realText(50, 2),
        'created_at' => $faker->dateTime('now', date_default_timezone_get()),
    ];
});
