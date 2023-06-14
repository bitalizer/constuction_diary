<?php

use EBuildingDiary\Event;
use Faker\Factory;
use Illuminate\Database\Seeder;

class EventSequencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            factory(Event::class, 5)->create();

            $faker = Factory::create();
            for ($i = 1; $i <= 10; $i++) {
                $start_datetime = $faker->dateTimeBetween($startDate = '-5 days', $endDate = '+5 days', $timezone = null);
                DB::table('event_sequences')->insert(
                    [
                        'event_id' => Event::select('id')->orderByRaw("RAND()")->first()->id,
                        'start_datetime' => $start_datetime,
                        'end_datetime' => $faker->dateTimeBetween($startDate = $start_datetime, $endDate = '+5 days', $timezone = null)
                    ]
                );
            }
        }
    }
}
