<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class competition_season extends Model
{
    public function teams()
    {
    	return $this->belongsToMany(team::class);
    }
    
}
