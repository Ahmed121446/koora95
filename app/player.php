<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class player extends Model
{
    //relationship between team and player
    // M player  --> 1 team    ===>  M to 1
    public function Team(){
    	return $this->belongTo(Team::class);
    } 


    //many players play in many seasons
    // M-M
    public function Seasons()
    {
    	return $this->belongsToMany(Season::class);
    }
}
