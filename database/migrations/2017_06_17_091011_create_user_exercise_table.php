<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserExerciseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('user_exercise', function (Blueprint $table) {
        $table->integer('user_id')->unsigned()->nullable();
        $table->foreign('user_id')->references('id')
        ->on('users')->onDelete('cascade');

        $table->integer('exercise_id')->unsigned()->nullable();
        $table->foreign('exercise_id')->references('id')
        ->on('exercises')->onDelete('cascade');

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
        Schema::dropIfExists('user_exercise');
    }
}
