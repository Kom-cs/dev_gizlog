<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Question::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 50),
        'tag_category_id' => $faker->numberBetween(1, 4),
        'title' => $faker->realText(30, 2),
        'content' => $faker->realText(50, 2),
        'created_at' => $faker->dateTime('now', date_default_timezone_get()),
    ];
});
