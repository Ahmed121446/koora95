<?php

namespace App\Repositories;

use App\Match;
use App\Season;
/**
* 
*/
class Matches
{
        
        public function confirm(Season $season, Match $match, $match_goals)
        {
                $competiton = $season->competiton;
                $is_cup = $competiton->is_cup();
                $first_team = $match->register_team_1_id;
                $second_team = $match->register_team_2_id;

                $first_team = $season->registeredTeams()->find($first_team);
                $second_team = $season->registeredTeams()->find($second_team);
                $first_team_goals = $match_goals['first_team_goals'];
                $second_team_goals = $match_goals['second_team_goals'];

                //to match model
                $match->match_played($first_team, $second_team);
                $match->match_winner($first_team_goals,$second_team_goals, $is_cup);
                $match->storeMatchGoals($first_team_goals,$second_team_goals);
                
                //to register team  model
                $first_team->storeTeamGolas($first_team_goals,$second_team_goals);
                $second_team->storeTeamGolas($second_team_goals,$first_team_goals);

                $match->save();
                $first_team->save();
                $second_team->save();
        }


}