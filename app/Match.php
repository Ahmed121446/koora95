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



    //calculate for match controller 
    public function match_winner($team_1_goals ,$team_2_goals, $is_cup){
        $first_team  = RegisteredTeam::find($this->register_team_1_id);
        $second_team = RegisteredTeam::find($this->register_team_2_id);

        if ($team_1_goals > $team_2_goals) {
           $this->winner_id = $first_team->id;
           $first_team->is_winner($is_cup);
           $second_team->losses +=1;
        }
        else if($team_1_goals < $team_2_goals){        
            $this->winner_id = $second_team->id;
            $second_team->is_winner($is_cup);
            $first_team->losses +=1;
        }else if(!$is_cup){
            $first_team->is_draw();
            $second_team->is_draw();
        }

        $first_team->save();
        $second_team->save();
    }


    public function match_played($first_team,$second_team){
        $this->is_played = true;
        $first_team->played += 1;
        $second_team->played += 1;
    }


    public function calculate_goals($team1_final_goals, $team2_final_goals)
    {
        $this->team_1_goals = $team1_final_goals;
        $this->team_2_goals = $team2_final_goals;
    }


}
