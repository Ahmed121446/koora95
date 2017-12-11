<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    public function stage()
    {
    	return $this->morphTo();
    }

    public function season()
    {
    	return $this->belongsTo(Season::class);
    }

    public function matches()
    {
    	return $this->hasMany(Match::class);
    }
}
