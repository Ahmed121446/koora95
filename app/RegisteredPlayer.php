<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

	/** @SWG\Definition(
    *          definition = "registeredPlayer",
    *          @SWG\Property(
    *              property="player_id",
    *              type="integer",
    *              description="player id",
    *              example="1"
    *          ),
    *  )
	*/

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
