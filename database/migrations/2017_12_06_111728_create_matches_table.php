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
<<<<<<< HEAD
            $table->integer('season_id');
            $table->integer('stage_id');
=======
            $table->date('date');
            $table->time('time');
>>>>>>> c9d49aa4166212cad17da8443f8eab9dc4687738
            $table->integer('register_team_1_id');
            $table->integer('register_team_2_id');
            $table->date('date');
            $table->time('time');  
            $table->string('stadium');
<<<<<<< HEAD
            $table->boolean('is_played');
=======
            $table->integer('season_id')->nullable();

>>>>>>> c9d49aa4166212cad17da8443f8eab9dc4687738
            $table->integer('team_1_goals');
            $table->integer('team_2_goals');
            $table->integer('winner_id');
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
        Schema::dropIfExists('matches');
    }
}
