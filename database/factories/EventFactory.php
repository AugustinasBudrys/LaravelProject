<?php

namespace App\Database\factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Event::class, function (Faker $faker) {
    return [
        'date' => $faker->date(),
        'time' => $faker->time(),
        'name' => $faker->word,
        'description' => $faker->text,
        'address' => $faker->address
    ];
});