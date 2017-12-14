<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends BaseModel
{
    // public function stage()
    // {
    // 	return $this->morphTo();
    // }

    public function stage()
    {
    	return $this->belongsTo(Stage::class);
    }

    public function season()
    {
    	return $this->belongsTo(Season::class);
    }


    public function register_team_1()
    {
        return $this->belongsTo(RegisteredTeam::class, 'register_team_1_id');
    }
    //team1
    public function getTeam1Attribute()
    {
        if(isset($this->register_team_1)){
            return $this->register_team_1->team;
        }

        return [];
    }

    public function register_team_2()
    {
         return $this->belongsTo(RegisteredTeam::class,'register_team_2_id');
    }
    //team2
    public function getTeam2Attribute()
    {
        if(isset($this->register_team_2)){
            return $this->register_team_2->team;
        }

        return [];

    }

      public function register_team_winner()
    {
         return $this->belongsTo(RegisteredTeam::class,'winner_id');
    }
    //winner
    public function getWinnerAttribute()
    {
        if (isset($this->register_team_winner)) {
            return $this->register_team_winner->team;
        }
    }

    //calculate for match controller 
    public function match_winner($team_1_goals ,$team_2_goals, $is_cup){
        $first_team  = RegisteredTeam::find($this->register_team_1_id);
        $second_team = RegisteredTeam::find($this->register_team_2_id);

        if ($team_1_goals > $team_2_goals) {
           $this->set_winner($first_team, $second_team, $is_cup);
        }
        else if($team_1_goals < $team_2_goals){        
            $this->set_winner($second_team, $first_team, $is_cup);
        }else if(!$is_cup){
            $this->set_draw($first_team, $second_team);
        }

        $first_team->save();
        $second_team->save();
    }


    public function set_winner($winner, $loser, $is_cup)
    {
        $this->winner_id = $winner->id;
        if(!$is_cup){
            $winner->points += 3;
        }
        $winner->wins += 1;
        $loser->losses += 1;
    }


    public function set_draw($first_team, $second_team)
    {
        $first_team->draws += 1;
        $second_team->draws += 1;
    }


    public function match_played($first_team,$second_team){
        $this->is_played = true;
        $first_team->played += 1;
        $second_team->played += 1;
    }


    public function storeMatchGoals($team1_final_goals, $team2_final_goals)
    {
        $this->team_1_goals = $team1_final_goals;
        $this->team_2_goals = $team2_final_goals;
    }

    public function storeMatchCards($match_cards)
    {
       $this->red_cards = $match_cards['first_team_cards']['first_team_red_cards'] + $match_cards['second_team_cards']['second_team_red_cards'];

        $this->yellow_cards = $match_cards['first_team_cards']['first_team_yellow_cards'] + $match_cards['second_team_cards']['second_team_yellow_cards'];
    }


}
