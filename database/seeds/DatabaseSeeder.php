<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PositionPermissionTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(DiariesTableSeeder::class);
        $this->call(DiaryEmployeeTableSeeder::class);
        $this->call(EmployeeProjectTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(EventSequencesTableSeeder::class);
        $this->call(EventEmployeeTableSeeder::class);
    }
}
