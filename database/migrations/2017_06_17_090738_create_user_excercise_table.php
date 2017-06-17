<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserExcerciseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('user_excercise', function (Blueprint $table) {
        $table->integer('user_id')->unsigned()->nullable();
        $table->foreign('user_id')->references('id')
        ->on('users')->onDelete('cascade');

        $table->integer('excercise_id')->unsigned()->nullable();
        $table->foreign('speciality_id')->references('id')
        ->on('specialities')->onDelete('cascade');

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
        //
    }
}
