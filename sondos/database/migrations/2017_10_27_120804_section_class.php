<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SectionClass extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sec_class');

        Schema::create('sec_class', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_id');
            $table->integer('section_id');
         //   $table->foreign('section_id')->references('id')->on('sections');
         //   $table->foreign('class_id')->references('id')->on('classss');
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
        Schema::dropIfExists('sec_class');
    }
}
