<?php

$factory->define(App\Team::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'size' => rand(5, 10),
    ];
});
