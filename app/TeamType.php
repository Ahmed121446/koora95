<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamType extends Model
{
    public function teams(){
    	return $this->hasMany(Team::class);
    } 
}
