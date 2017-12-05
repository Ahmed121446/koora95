<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends BaseModel
{
    public function competitions()
    {
    	return $this->belongsTo(Competition::class);
    }


     //many players play in many seasons
    // M-M
    public function Players()
    {
    	return $this->belongsToMany(player::class);
    }
}
