<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends BaseModel
{
    public function competitions()
    {
    	return $this->morphMany('App\Competition', 'location');
    }
}
