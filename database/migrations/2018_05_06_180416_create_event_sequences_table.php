<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventSequencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_sequences', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
            $table->integer('event_id')->unsigned();
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');

            $table->foreign('event_id')->references('id')->on('events')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_sequences');
    }
}
