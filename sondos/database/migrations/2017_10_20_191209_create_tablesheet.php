<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tablesheets');

        Schema::create('tablesheets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_id');
            $table->integer('row');
            $table->integer('column');
            $table->integer('course_id');
            $table->foreign('class_id')->references('id')->on('classss');
            $table->foreign('course_id')->references('id')->on('courses');
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
        Schema::dropIfExists('tablesheets');
    }
}
