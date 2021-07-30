<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\JobRole;
use Faker\Generator as Faker;

$factory->define(JobRole::class, function (Faker $faker) {
    return [
        'name:en' => $faker->name,
        'name:ar'=> 'الحمدلله',
    ];
});
