<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    public function stage()
    {
    	return $this->morphTo();
    }
}
