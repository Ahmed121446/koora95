<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//for Team properties
/**
 * @SWG\Definition(
 *      definition = "Team_creation",
 *      @SWG\Property(
 *          property="name",
 *          type="string",
 *          example="banha"
 *      ),
 *     @SWG\Property(
 *          property="type_id",
 *          type="integer",
 *          example="1"
 *      ),      
 *      @SWG\Property(
 *          property="logo",
 *          type="string",
 *          example="logo.png"
 *      ),
 *      @SWG\Property(
 *          property="stadium",
 *          type="string",
 *          example="Banha stadium"
 *      ),
 *      @SWG\Property(
 *          property="country_id",
 *          type="integer",
 *          example="2"
 *      )
 * )

 */
class Team extends BaseModel
{

	// Team can Participate in many Competitions
    public function competitions()
    {
    	return $this->belongsToMany(competition::class);
    }

    public function country()
    {
       return $this->belongsTo(Country::class);
    }

    public function registeredTeam()
    {
        return $this->hasMany(RegisteredTeam::class);
    }

    //relationship between team and player
    // M player  --> 1 team    ===>  M to 1
    public function players(){
    	return $this->hasMany(player::class);
    } 

    public function teamType()
    {
        return $this->belongsTo(TeamType::class,'type_id');
    }

}
