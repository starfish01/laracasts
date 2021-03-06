<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Integration_data;
use Faker\Generator as Faker;

$factory->define(Integration_data::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'owner_id' => function() {
            return factory(App\User::class)->create()->id;
        }
    ];
});
