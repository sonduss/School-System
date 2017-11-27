<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimetable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('timetables');

        Schema::create('timetables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('row');
            $table->integer('column');
            $table->integer('teacher_id');
            $table->integer('course_id');
            $table->foreign('teacher_id')->references('id')->on('teechers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timetables');
    }
}
