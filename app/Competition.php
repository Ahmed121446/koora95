<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

    /** @SWG\Definition(
     *          definition = "competition",
     *          @SWG\Property(
     *              property="name",
     *              type="string",
     *              description="competition name",
     *              example="Egyptian league"
     *          ),
     *
     *          @SWG\Property(
     *              property="type",
     *              type="integer",
     *              description="competition type id",
     *              example="1 for league & 2 for cup"
     *          ),
     *          @SWG\Property(
     *              property="country_id",
     *              type="integer",
     *              description="competition country id",
     *              example="(if the competition is local)"
     *          ),
     *          @SWG\Property(
     *              property="continent_id",
     *              type="integer",
     *              description="competition continent id",
     *              example="(if the competition is continental)"
     *          ),
     *  )
     */

class competition extends BaseModel
{
	public function location()
	{
		return $this->morphTo();
	}

    public function competitionType()
    {
       return $this->belongsTo(CompetitionType::class,'comp_type_id');
    }



	// Competition Has Many Seasons
    public function seasons(){
    	return $this->hasMany(Season::class,'comp_id');
    }


    public function is_cup()
    {
    	return $this->comp_type_id == 2 ? true : false;
    }


    public function is_league()
    {
    	return $this->comp_type_id == 1 ? true : false;
    }

}
