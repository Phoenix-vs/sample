<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Status::class, function (Faker $faker) {
    $users_id = [1, 2, 3, 4, 5];
    $content = $faker->text;
    $time = $faker->date() . ' ' . $faker->time();
    return [
        //
        'content' => $content,
        'user_id' => $faker->randomElement($users_id),
        'created_at' => $time,
    ];
});
