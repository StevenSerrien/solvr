<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePracticeSpecialityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practice_speciality', function (Blueprint $table) {
          $table->integer('practice_id')->unsigned()->nullable();
          $table->foreign('practice_id')->references('id')
          ->on('practices')->onDelete('cascade');

          $table->integer('speciality_id')->unsigned()->nullable();
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
        Schema::dropIfExists('practice_speciality');
    }
}
