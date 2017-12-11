<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    public function matches()
    {
    	return $this->morphMany('App\Match','stage');
    }
}
