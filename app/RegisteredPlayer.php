<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisteredPlayer extends Model
{
    public function Team(){
    	return $this->belongsTo(RegisteredTeam::class);
    }
}
