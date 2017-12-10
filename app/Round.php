<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    public function matchs()
    {
    	return $this->morphMany('App\Match','Match');
    }
}
