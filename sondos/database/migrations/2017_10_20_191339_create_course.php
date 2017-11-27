<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('courses');

        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
          //  $table->string('name');
            $table->integer('class_id');
            $table->integer('section_id');
            $table->integer('teacher_id');
            $table->integer('subject_id');
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('classss');
            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('subject_id')->references('id')->on('ds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
