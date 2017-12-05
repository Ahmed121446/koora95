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
}
