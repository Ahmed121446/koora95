<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Season;
use App\Team;


class Registered_Team_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
            public function run()
            {
                for ($i=0; $i < 30; $i++) { 
                   DB::table('registered_teams')->insert([
                      'team_id' =>Team::all()->random()->id, 
                      'season_id' => 9,

                      'played' => 0,
                      'wins' => 0,
                      'losses' => 0,
                      'draws' => 0,
                      'goals_for' => 0,
                      'goals_against' => 0,
                      'points' => 0,
                      'red_cards' => 0,
                      'yellow_cards' => 0    

                  ]);
               }
           }
       }
