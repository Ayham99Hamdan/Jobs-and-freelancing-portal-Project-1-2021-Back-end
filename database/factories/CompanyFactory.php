<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(\App\Models\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => $faker->password,
        'avatar' => $faker->imageUrl(),
        'job_role_id' => $faker->numberBetween(1,10),
        'description' => $faker->text,
    ];
});
