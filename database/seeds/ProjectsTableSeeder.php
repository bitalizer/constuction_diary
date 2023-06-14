<?php

use EBuildingDiary\Project;
use Faker\Factory;
use Illuminate\Database\Seeder;


class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            $faker = Factory::create();

            $project = new Project();
            $project->name = 'Tallinna trammitee ehitus';
            $project->location = $faker->streetAddress;
            $project->save();

            $project = new Project();
            $project->name = 'Tartu Ülikooli spordihoone ehitus';
            $project->location = $faker->streetAddress;
            $project->save();

            $project = new Project();
            $project->name = 'Värvikeskuste kaupluse ehitus';
            $project->location = $faker->streetAddress;
            $project->save();

            $project = new Project();
            $project->name = 'Kummeli korterelamu ehitus';
            $project->location = $faker->streetAddress;
            $project->save();
        }
    }
}
