<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends BaseModel
{

	//relation 1-comp - M-Seasons
   public function competiton(){
   	return $this->belongsTo(competition::class,'comp_id');
   }
}
