<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisteredPlayer extends Model
{
    public function registeredTeam(){
    	return $this->belongsTo(RegisteredTeam::class,'registered_team_id');
    }
    
    public function player()
    {
    	return $this->belongsTo(player::class,'player_id');
    }
}
