<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Match;
use App\Stage;
use App\RegisteredTeam;

class MatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$match_status = ['Not Player Yet','In Progress','Finished'];
    	$k = array_rand($match_status);
		$v = $match_status[$k];

        DB::table('matches')->insert([
        	'season_id' => 9,
        	'stage_id' => Stage::all()->random()->id,
        	'status' => $v,
        	'register_team_1_id' => 9,
        	'register_team_2_id' => 4,
        	'date' =>"2017-12-13",

        	'time' => "12:00:00",
        	'stadium' => "zamalek stadium",
        	'team_1_goals' => 2,
        	'team_2_goals' => 1,

        	'winner_id' => 9,
        	'red_cards' => 1,
        	'yellow_cards' => 2
        ]);
    }
}
