<?php

use EBuildingDiary\Employee;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            Employee::create([
                'name' => 'Elmar Sarapu',
                'email' => 'demo@example.com',
                'password' => bcrypt('demo'),
                'phone_number' => '58000000',
                'position_id' => 1,
                'hire_date' => '2007-12-10 22:19:43',
                'remember_token' => str_random(10),
            ]);

            Employee::create([
                'name' => 'Henno Täht',
                'email' => 'foreman@example.com',
                'password' => bcrypt('demo'),
                'phone_number' => '58000000',
                'position_id' => 2,
                'hire_date' => '2007-12-10 22:19:43',
                'remember_token' => str_random(10),
            ]);

            Employee::create([
                'name' => 'Indrek Sonberg',
                'email' => 'boss@example.com',
                'password' => bcrypt('demo'),
                'phone_number' => '58000000',
                'position_id' => 3,
                'hire_date' => '2007-12-10 22:19:43',
                'remember_token' => str_random(10),
            ]);

            Employee::create([
                'name' => 'Ly Otsa',
                'email' => 'ly.otsa@example.com',
                'password' => bcrypt('demo'),
                'phone_number' => '58000000',
                'position_id' => 3,
                'hire_date' => '2007-12-10 22:19:43',
                'remember_token' => str_random(10),
            ]);

            factory(Employee::class, 35)->create();

        }
    }
}
