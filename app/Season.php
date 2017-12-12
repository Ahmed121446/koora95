<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends BaseModel
{

	//relation 1-comp - M-Seasons
   public function competiton(){
   		return $this->belongsTo(competition::class,'comp_id');
   }

    public function registeredTeams(){
   		return $this->hasMany(RegisteredTeam::class);
   }

   public function matches()
   {
   		return $this->hasMany(Match::class);
   }


   public function stages()
   {
         return $this->hasMany(Stage::class);
   }
   
   public function groups()
   {
         return $this->hasMany(Group::class);
   }

}
