<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class continent extends BaseModel
{
	 public function competitions()
    {
    	return $this->morphMany('App\Competition', 'location');
    }
} 

