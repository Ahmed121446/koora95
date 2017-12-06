<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisteredTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registered_teams', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('season_id');
            $table->integer('team_id');
            $table->unique(['season_id', 'team_id']);

            $table->integer('played');
            $table->integer('wins');
            $table->integer('losses');
            $table->integer('draws');
            $table->integer('goals_for');
            $table->integer('goals_against');
            $table->integer('points');
            $table->integer('red_cards');
            $table->integer('yellow_cards');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registered_teams');
    }
}
