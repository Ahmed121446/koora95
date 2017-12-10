<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class competition extends BaseModel
{
	public function location()
	{
		return $this->morphTo();
	}
	// Competition Has Many Seasons
    public function seasons(){
    	return $this->hasMany(Season::class,'comp_id');
    }

}
