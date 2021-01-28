<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('film_id')->unsigned()->nullable();
            $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');
            $table->foreignId('people_id')->unsigned()->nullable();
            $table->foreign('people_id')->references('id')->on('people')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film_people');
    }
}
