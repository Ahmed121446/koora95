<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends BaseModel
{
    public function competitions()
    {
    	return $this->belongsTo(Competition::class);
    }
}
