<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisteredTeam extends BaseModel
{

    public function seasons()
    {
    	return $this->belongsTo(Season::class);
    }

    public function registeredPlayers(){
    	return $this->hasMany(RegisteredPlayer::class);
    }

    public function calculate_goals($goals_for ,$goals_against){
    	$this->goals_for += $goals_for;
        $this->goals_against += $goals_against;
    }

    public function is_winner()
    {
    	$this->wins +=1;
    	$this->points +=3;
    }
    public function is_draw()
    {
    	$this->draws +=1;
    	$this->points +=1;
    }
    
}
