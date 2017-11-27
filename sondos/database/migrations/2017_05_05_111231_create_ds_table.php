<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::dropIfExists('ds');

        Schema::create('ds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('subject_code');
            $table->integer('total_lecture');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('ds');

    }
}
