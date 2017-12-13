<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_teams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id');
            $table->integer('register_team_id');
            $table->integer('played');
            $table->integer('wins');
            $table->integer('losses');
            $table->integer('draws');
            $table->integer('goals_for');
            $table->integer('goals_against');
            $table->integer('points');
            $table->integer('red_cards');
            $table->integer('yellow_cards');
            $table->unique(['group_id','register_team_id']);
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
        Schema::dropIfExists('group_teams');
    }
}
