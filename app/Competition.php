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


    public function is_cup()
    {
    	return $this->comp_type_id == 2 ? true : false;
    }


    public function is_league()
    {
    	return $this->comp_type_id == 1 ? true : false;
    }

}
