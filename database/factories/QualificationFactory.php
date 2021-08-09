<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Qualification;

use Faker\Generator as Faker;

$factory->define(Qualification::class, function (Faker $faker) {
    return [
        'name:en' => $faker->name,
        'name:ar' => \Faker\Provider\ar_JO\Person::firstNameMale()
    ];
});
