<?php

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

$factory->define(App\Employees::class, function (Faker $faker) {
    return [
        'employeeKey' => $faker->numberBetween(1000, 1564789565),
        'name' => $faker->name,
        'age' => $faker->numberBetween(18, 50),
        'position' => $faker->jobTitle,
        'address' => $faker->address,
    ];
});
