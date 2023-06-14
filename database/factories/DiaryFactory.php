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

use EBuildingDiary\Project;

$factory->define(EBuildingDiary\Diary::class, function (Faker\Generator $faker) {

    return [
        'submitter_id' => $faker->numberBetween(1, 10),
        'project_id' => Project::all()->random()->id,
        'mechanisms' => $faker->sentence(5),
        'equipment' => $faker->sentence(7),
        'work_description' => $faker->sentence(7),
        'comments' => $faker->sentence(8),
        'instructions' => $faker->sentence(8),
        'acts_and_documents' => $faker->sentence(8),
        'control' => $faker->sentence(8),
        'weather_time' => $faker->dateTime($max = 'now', $timezone = null),
        'weather_temperature' => $faker->numberBetween(-25, 25),
        'weather_snow' => $faker->boolean(),
        'weather_dry' => $faker->boolean(),
        'weather_rain' => $faker->boolean(),
        'weather_wind' => $faker->boolean(),
        'weather_sleet' => $faker->boolean(),
        'date' => $faker->dateTimeBetween($startDate = '-3 months', $endDate = 'now', $timezone = null)
    ];
});
