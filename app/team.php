<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class team extends Model
{
    public function competition_season()
    {
    	return $this->belongsToMany(competition_season::class);
    }
}
