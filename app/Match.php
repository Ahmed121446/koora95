<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends BaseModel
{
    // public function stage()
    // {
    // 	return $this->morphTo();
    // }

    public function stage()
    {
    	return $this->belongsTo(Stage::class);
    }

    public function season()
    {
    	return $this->belongsTo(Season::class);
    }
}
