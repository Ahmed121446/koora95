<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class season extends Model
{
    public function competitions()
    {
    	return $this->belongsToMany(season::class);
    }
}
