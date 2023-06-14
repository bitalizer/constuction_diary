<?php

use EBuildingDiary\Employee;
use EBuildingDiary\Project;
use Illuminate\Database\Seeder;
use Faker\Factory;

class EmployeeProjectTableSeeder extends Seeder
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

            $employees = Employee::all();
            $projects = Project::all();

            foreach($employees as $employee){
                foreach($projects as $project){
                    $data[] = [
                        'project_id' => $project->id,
                        'employee_id' => $employee->id,
                        'hourly_rate' => $faker->randomFloat(2, 6, 12),
                        'weekend_payable' => $faker->boolean(),
                        'holiday_payable' => $faker->boolean(),
                        'night_shift_payable' => $faker->boolean(),
                        'start_date' => $faker->dateTimeBetween($startDate = '-5 months', $endDate = '-4 months', $timezone = null)
                    ];
                }
            }

            DB::table('employee_project')->insert($data);
        }
    }
}
