<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Experience;
use Faker\Generator as Faker;

$factory->define(Experience::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,500),
        'job_title' => $faker->title,
        'company_name' => $faker->name,
        'job_role_id' => $faker->numberBetween(1,10),
        'start_date'  => $faker->dateTime,
        //TODO cc
    ];
});
