<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisteredPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registered_players', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('registered_team_id');
            $table->integer('player_id');
            $table->unique(['registered_team_id','player_id']);

            $table->integer('played');
            $table->integer('goals');
            $table->integer('assists');
            $table->integer('red_cards');
            $table->integer('yellow_cards');

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
        Schema::dropIfExists('registered_players');
    }
}
