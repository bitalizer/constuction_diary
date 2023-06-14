<?php

use EBuildingDiary\Diary;
use EBuildingDiary\Employee;
use Illuminate\Database\Seeder;
use Faker\Factory;

class DiaryEmployeeTableSeeder extends Seeder
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
            $data = [];

            foreach (range(1, 250) as $index) {
                $data[] = [
                    'diary_id' => Diary::all()->random()->id,
                    'employee_id' => Employee::all()->random()->id,
                    'start_time' => $faker->time('H:i', $max = 'now'),
                    'end_time' => $faker->time('H:i', $max = 'now'),
                    'hours' => $faker->numberBetween(7, 12),
                    'note' => $faker->sentence(3),
                    'weekend' => $faker->boolean(),
                    'holiday' => $faker->boolean(),
                    'night_shift' => $faker->boolean()
                ];
            }

            DB::table('diary_employee')->insert($data);
        }
    }
}
