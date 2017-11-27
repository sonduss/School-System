<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeecher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('teachers');

        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('idinti');
            $table->string('specialize');
            $table->string('email')->unique();
            $table->string('dateBirth');
            $table->integer('phone');
            $table->string('password');
            $table->string('address');
            $table->string('gender');
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
        Schema::dropIfExists('teachers');
    }
}
