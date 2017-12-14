<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    public function stage()
    {
    	return $this->belongsTo(Stage::class);
    }

    public function groupTeams()
    {
    	return $this->hasMany(GroupTeams::class);
    }


    public function groupRounds()
    {
        return $this->hasMany(GroupRound::class);
    }

    

    // public function getRouteKeyName()
    // {
    // 	return 'name';
    // }

}
