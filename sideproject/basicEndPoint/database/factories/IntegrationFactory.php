<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Integration;
use Faker\Generator as Faker;

$factory->define(Integration::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'owner_id' => function() {
            return factory(App\User::class)->create()->id;
        },
        'integration_id' => function () {
            return factory(App\Integration::class)->create()->id;
        }
    ];
});
