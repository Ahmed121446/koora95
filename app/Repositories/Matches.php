<?php

namespace App\Repositories;

use App\Match;
use App\Season;
/**
* 
*/
class Matches
{
        
        public function confirm(Season $season, Match $match, $match_goals , $match_cards)
        {
                $competiton = $season->competiton;
                $is_cup = $competiton->is_cup();
                $first_team = $match->register_team_1_id;
                $second_team = $match->register_team_2_id;

                $first_team = $season->registeredTeams()->find($first_team);
                $second_team = $season->registeredTeams()->find($second_team);
                $first_team_goals = $match_goals['first_team_goals'];
                $second_team_goals = $match_goals['second_team_goals'];

                $first_team_Y_cards = $match_cards['first_team_cards']['first_team_yellow_cards'];
                $first_team_R_cards = $match_cards['first_team_cards']['first_team_red_cards'];
                $second_team_Y_cards = $match_cards['second_team_cards']['second_team_yellow_cards'];
                $second_team_R_cards = $match_cards['second_team_cards']['second_team_red_cards'];



                //to match model
                $match->match_played($first_team, $second_team);
                $match->match_winner($first_team_goals,$second_team_goals, $is_cup);
                $match->storeMatchGoals($first_team_goals,$second_team_goals);
                $match->storeMatchCards($match_cards);
                
                //to register team  model
                $first_team->storeTeamGolas($first_team_goals,$second_team_goals);
                $second_team->storeTeamGolas($second_team_goals,$first_team_goals);
                $first_team->storeTeamCards($first_team_Y_cards , $first_team_R_cards);
                $second_team->storeTeamCards($second_team_Y_cards ,$second_team_R_cards);
                

                $match->save();
                $first_team->save();
                $second_team->save();
        }


}