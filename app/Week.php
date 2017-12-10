<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
     public function matchs()
    {
    	return $this->morphMany('App\Match','Match');
    }
}
