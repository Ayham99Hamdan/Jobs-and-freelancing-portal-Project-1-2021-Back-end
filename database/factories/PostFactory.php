<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;

use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'company_id' => $faker->numberBetween(1,150),
        'job_role_id' => $faker->numberBetween(1,10),
        'title' => $faker->sentence,
        'job_type' => $faker->sentence(5),
        'start_salary' => $faker->numberBetween(200000,400000),
        'experience_years' => $faker->numberBetween(1,15),
        'description' => $faker->text

    ];
});
