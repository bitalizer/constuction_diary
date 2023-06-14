<?php

use Illuminate\Database\Seeder;

class EventEmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            for ($i = 1; $i <= 40; $i++) {
                DB::table('event_employee')->insert(
                    [
                        'event_id' => \EBuildingDiary\Event::select('id')->orderByRaw("RAND()")->first()->id,
                        'employee_id' => \EBuildingDiary\Employee::select('id')->orderByRaw("RAND()")->first()->id,
                    ]
                );
            }
        }
    }
}
