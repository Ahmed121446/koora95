<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class continent extends Model
{
    public function Countries(){
    	// continent has many Countries   ---->   1-M    relationship
    	return $this->hasMany(\App\Country::class);
    }
}
