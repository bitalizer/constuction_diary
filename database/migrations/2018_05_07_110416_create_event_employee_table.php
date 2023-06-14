<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_employee', function (Blueprint $table) {
            $table->integer('event_id')->unsigned();
            $table->integer('employee_id')->unsigned();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('restrict');
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
        Schema::dropIfExists('event_employee');
    }
}
