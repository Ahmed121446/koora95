<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *      definition = "group",
 *      @SWG\Property(
 *          property="groups_number",
 *          type="string",
 *          example=2
 *      ),
 *      @SWG\Property(
 *          property="teams_number",
 *          type="string",
 *          example=4
 *      ),
 *     @SWG\Property(
 *          property="home_away",
 *          type="boolean",
 *          example="true/false"
 *      ) 
 * )
 */
class Group extends Model
{

    public function stage()
    {
    	return $this->belongsTo(Stage::class);
    }

    public function groupTeams()
    {
    	return $this->hasMany(GroupTeams::class);
    }


    public function groupRounds()
    {
        return $this->hasMany(GroupRound::class);
    }

    

    public function teamsRanking()
  {
      return $this->groupTeams()->orderBy('points', 'desc')->get();
  }

}
