<?php

namespace App\Repositories;

use App\Match;
use App\Season;
use App\Stage;
use App\Group;
/**
* 
*/
class Matches
{
        
    public function confirm(Season $season, Match $match, $match_goals , $match_cards)
    {
        // Get Match type
        $competiton = $season->competiton;
        $is_cup = $competiton->is_cup();

        // Match is Played 
        $match->status = "played";

        // set the Winner 
        $first_team_goals = Request('first_team_goals');

        $second_team_goals = Request('second_team_goals');

        $match->match_winner($first_team_goals, $second_team_goals, $is_cup);

        // store Match Goals And cards
        $match->storeMatchGoals($first_team_goals,$second_team_goals);
        $match->storeMatchCards($match_cards);

        // Get IDs of teams
        $first_team = $match->register_team_1_id;
        $second_team = $match->register_team_2_id;

        // save the Match
        $match->save();

        // If group stage  
        if($match->group_round_id){
                $stage = $season->stages()->find($match->stage_id);
                $group = $stage->groups()->find($match->group_id);

                $first_team = $group->groupTeams()
                                    ->where('register_team_id', $first_team)
                                    ->first();
                
                $second_team = $group->groupTeams()
                                     ->where('register_team_id', $second_team)
                                     ->first();
        }else{
                $first_team = $season->registeredTeams()->find($first_team);
                $second_team = $season->registeredTeams()->find($second_team);
        }

        $this->calculateStandings($first_team, $second_team, $match, $is_cup);
        
        $this->storeGoals($first_team, $second_team, $match_goals);

        $this->storeCards($first_team, $second_team, $match_cards);         
        
        $first_team->save();
        $second_team->save();
    }


    
    private function storeGoals($first_team, $second_team, $goals)
    {
        $first_team_goals = $goals['first_team_goals'];
        $second_team_goals = $goals['second_team_goals'];

        $first_team->storeTeamGolas($first_team_goals,$second_team_goals);
        $second_team->storeTeamGolas($second_team_goals,$first_team_goals);
    }


    private function storeCards($first_team, $second_team, $cards)
    {
        $first_team_Y_cards = $cards['first_team_cards']['first_team_yellow_cards'];
        $first_team_R_cards = $cards['first_team_cards']['first_team_red_cards'];
        $second_team_Y_cards = $cards['second_team_cards']['second_team_yellow_cards'];
        $second_team_R_cards = $cards['second_team_cards']['second_team_red_cards'];

        $first_team->storeTeamCards($first_team_Y_cards , $first_team_R_cards);
        $second_team->storeTeamCards($second_team_Y_cards ,$second_team_R_cards);
    }


    private function calculateStandings($first_team, $second_team ,$match, $is_cup)
    {
        switch ($match->winner_id) {
                case $first_team->id : {
                        $winner = $first_team;
                        $loser = $second_team;
                }
                        break;

                 case $first_team->id : {
                        $winner = $second_team;

                        $loser = $first_team;
                }
                        break;
                
                 case 0 : {

                        $match->set_draw($first_team, $second_team);
                }
                        break;
        }

        $match->set_winner($winner, $loser, $is_cup);

    }


}