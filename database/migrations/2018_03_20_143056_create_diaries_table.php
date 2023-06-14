<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diaries', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
            $table->unsignedInteger('submitter_id');
            $table->unsignedInteger('project_id');
            $table->mediumText('mechanisms')->nullable();
            $table->mediumText('equipment')->nullable();
            $table->mediumText('work_description');
            $table->mediumText('comments')->nullable();
            $table->mediumText('instructions')->nullable();
            $table->mediumText('acts_and_documents')->nullable();
            $table->mediumText('control')->nullable();
            $table->time('weather_time');
            $table->smallInteger('weather_temperature');
            $table->boolean('weather_snow');
            $table->boolean('weather_dry');
            $table->boolean('weather_rain');
            $table->boolean('weather_wind');
            $table->boolean('weather_sleet');
            $table->date('date');
            $table->timestamps();

            $table->foreign('submitter_id')->references('id')->on('employees')->onDelete('restrict');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diaries');
    }
}
