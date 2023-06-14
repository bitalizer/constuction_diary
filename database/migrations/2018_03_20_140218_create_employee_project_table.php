<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_project', function (Blueprint $table) {
            $table->integer('project_id')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->decimal('hourly_rate', 4,2)->unsigned()->default(0.00);
            $table->boolean('weekend_payable')->default(false);
            $table->boolean('holiday_payable')->default(false);
            $table->boolean('night_shift_payable')->default(false);
            $table->date('start_date');
            $table->date('end_date')->nullable();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('restrict');
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
        Schema::dropIfExists('employee_project');
    }
}
