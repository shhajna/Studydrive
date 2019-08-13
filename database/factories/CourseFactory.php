<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Course::class, function (Faker $faker) {
    return [
        'name' => $faker->regexify('[a-z]{20}'),
        'capacity' => $faker->numberBetween(3, 8)
    ];
});
