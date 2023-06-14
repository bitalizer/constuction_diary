<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EBuildingDiary\Position;

$factory->define(EBuildingDiary\Employee::class, function (Faker\Generator $faker) {
    
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('demo'),
        'phone_number' => $faker->phoneNumber,
        'position_id' => Position::all()->random()->id,
        'hire_date' => $faker->dateTimeBetween($startDate = '-4 years', $endDate = '-9 months', $timezone = null),
        'remember_token' => str_random(10),
    ];
});
