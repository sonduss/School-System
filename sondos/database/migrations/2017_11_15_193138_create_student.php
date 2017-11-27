<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('students');

        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('gender');
            $table->string('fname');
            $table->string('lname');
            $table->text('image');
            $table->string('nationality');
            $table->string('religon');
            $table->integer('fee_dis');
            $table->string('address');
            $table->integer('phone');
            $table->date('dateofbirth');
            $table->string('password');


            $table->string('father_name');

            $table->string('father_occu');
            $table->integer('father_id_card');
            $table->integer('father_phone');

            $table->integer('mother_id_card');
            $table->string('mother_occu');
            $table->integer('mother_phone');
            $table->string('gurd_name');
            $table->string('gurd_relation');
            $table->integer('gurd_phone');
            $table->string('gurd_address');
            $table->string('gurd_ocuup');
            $table->integer('gurd_id_card');
            $table->string('mother_name');
            $table->string('prevschool');
            $table->string('guardian_is');

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
        Schema::dropIfExists('students');
    }
}
