<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    public function season()
    {
    	return $this->belongsTo(Season::class);
    }

    public function Group_Teams()
    {
    	return $this->hasMany(Group_Teams::class);
    }

    public function getRouteKeyName()
    {
    	return 'name';
    }

}
