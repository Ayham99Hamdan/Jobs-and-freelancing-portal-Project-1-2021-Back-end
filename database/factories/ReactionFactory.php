<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reaction;
use Faker\Generator as Faker;

$factory->define(Reaction::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,500),
        'post_id' => $faker->numberBetween(1,300),
    ];
});
