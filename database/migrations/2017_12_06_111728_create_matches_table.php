<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('register_team_1_id');
            $table->integer('register_team_2_id');
            $table->string('stadium');
            $table->integer('season_id');

            $table->integer('team_1_goals');
            $table->integer('team_2_goals');

            $table->integer('red_cards');
            $table->integer('yellow_cards');

            $table->morphs('stage');
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
        Schema::dropIfExists('matches');
    }
}
