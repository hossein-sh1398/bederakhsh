<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Campaign;

$factory->define(Campaign::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
