<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class competition extends BaseModel
{
	// Competition Has Many Seasons
    public function seasons(){
    	return $this->hasMany(Season::class);
    }

}
