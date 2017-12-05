<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class competition extends BaseModel
{
    public function seasons()
    {
    	return $this->hasMany(Season::class);
    }
}
