<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Gradebook;
use Illuminate\Support\Str;
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

$factory->define(Gradebook::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'professor_id' => $faker->randomDigit            
    ];
});
