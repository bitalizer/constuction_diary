<?php

use EBuildingDiary\Diary;
use Illuminate\Database\Seeder;

class DiariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            factory(Diary::class, 50)->create();
        }
    }
}
