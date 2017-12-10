<?php

use Illuminate\Database\Seeder;
use App\CompetitionTeam;

use App\player;
use App\Team;
class RegisterPlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=0; $i < 110 ; $i++) { 
    		 DB::table('registered_players')->insert([

	        	'registered_team_id' => Team::all()->random()->id,
	        	'player_id' => player::all()->random()->id,
                'played' => 0,
                'goals' => 0,
                'assists' => 0,
                'red_cards' => 0,
                'yellow_cards' => 0
       		 ]);
    	}
       
    }
}
