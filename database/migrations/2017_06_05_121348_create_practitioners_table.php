<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreatePractitionersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practitioners', function (Blueprint $table) {
          $table->increments('id');
          $table->string('firstname');
          $table->string('lastname');
          $table->string('rizivnumber');
          $table->string('email')->unique();
          $table->string('password');

          $table->boolean('isAdmin')->default(0);
          $table->boolean('isConfirmed')->default(0);
          $table->string('confirmation_code')->nullable();

          // Foreign key
          $table->integer('practice_id')->unsigned();

          $table->rememberToken();
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
        Schema::dropIfExists('practitioners');
    }
}
