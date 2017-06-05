<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePracticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('streetname');
            $table->string('housenumber');
            $table->string('locality');
            $table->integer('postal_code');
            $table->string('telephone');

            $table->decimal('lng', 10, 7);
            $table->decimal('lat', 10, 7);

            $table->boolean('isConfirmed')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practices');
    }
}
