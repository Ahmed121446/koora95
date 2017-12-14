<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends BaseModel
{

	// Team can Participate in many Competitions
    public function competitions()
    {
    	return $this->belongsToMany(competition::class);
    }

    public function country()
    {
       return $this->belongsTo(Country::class);
    }

    public function registeredTeam()
    {
        return $this->hasMany(RegisteredTeam::class);
    }

    //relationship between team and player
    // M player  --> 1 team    ===>  M to 1
    public function players(){
    	return $this->hasMany(player::class);
    } 

    public function teamType()
    {
        return $this->belongsTo(TeamType::class,'type_id');
    }
    
}
