<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends BaseModel
{
    public function stage()
    {
    	return $this->morphTo();
    }

    public function season()
    {
    	return $this->belongsTo(Season::class);
    }

    public function matches()
    {
    	return $this->hasMany(Match::class);
    }


    public function groups()
    {
        return $this->hasMany(Group::class);
    }


    public function groupRounds()
    {
        return $this->hasMany(GroupRound::class);
    }


    public function addRounds($rounds_number)
    {
        for ($i=1; $i <= $rounds_number; $i++) {
            $round = new GroupRound(['round_number' => $i]);
            $this->groupRounds()->save($round);
        }
    }


    public function has_groups()
    {
        return $this->groups()->first() ? true : false;
    }
}
