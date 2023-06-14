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
$factory->define(EBuildingDiary\Event::class, function (Faker\Generator $faker) {

    return [
        'creator_id' => \EBuildingDiary\Employee::select('id')->orderByRaw("RAND()")->first()->id,
        'title' => $faker->sentence(2),
        'information' => $faker->sentence(7),
        'color' => $faker->safeHexColor()
    ];
});
