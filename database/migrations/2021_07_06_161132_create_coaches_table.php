<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaches', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('sport_id')->unsigned()->nullable();
            $table->foreign('sport_id')->references('id')->on('sports');
            $table->bigInteger('academy_id')->unsigned()->nullable();
            $table->foreign('academy_id')->references('id')->on('academies');
            $table->string('city')->nullable();
            $table->string('nationality')->nullable();
            $table->string('nationality_id')->nullable();
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
        Schema::dropIfExists('coaches');
    }
}
