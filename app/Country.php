<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends BaseModel
{
	public function continent()
	{
		return $this->belongsTo(continent::class,'continent_id');
	}

    public function competitions()
    {
    	return $this->morphMany('App\Competition', 'location');
    }

    public function teams(){
    	return $this->hasMany(Team::class);
    } 
    public function players(){
        return $this->hasMany(player::class);
    } 
}
