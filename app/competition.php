<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class competition extends Model
{
    public function seasons()
    {
    	return $this->belongsToMany(season::class);
    }
}
