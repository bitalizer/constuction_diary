<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiaryEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diary_employee', function (Blueprint $table) {
            $table->integer('diary_id')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->time('start_time');
            $table->time('end_time');
            $table->decimal('hours', 3,1);
            $table->string('note')->nullable();
            $table->boolean('weekend')->default(0);
            $table->boolean('holiday')->default(0);
            $table->boolean('night_shift')->default(0);

            $table->foreign('diary_id')->references('id')->on('diaries')->onDelete('restrict');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diary_employee');
    }
}
