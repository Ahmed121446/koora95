<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupRound extends BaseModel
{
    	
    public function stage()
    {
    	return $this->belongsTo(Stage::class);
    }

}
