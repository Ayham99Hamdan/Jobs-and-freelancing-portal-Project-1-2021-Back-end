<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Education;
use Faker\Generator as Faker;

$factory->define(Education::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,500),
        'qualification_id' => $faker->numberBetween(1,20),
        'graduation_rate' => $faker->numberBetween(0,5),
        'instituation_name' => $faker->name,
        'study_field' => $faker->name(),
        'start_date' => $faker->date('Y-m-d'),
        'end_date' => $faker->date('Y-m-d'),
        //TODO

    ];
});
