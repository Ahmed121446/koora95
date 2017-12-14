<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class continent extends BaseModel
{
	public function countries()
	{
		return $this->hasMany(Country::class);
	}
	public function competitions()
    {
    	return $this->morphMany('App\Competition', 'location');
    }
} 

