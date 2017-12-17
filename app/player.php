<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//for player properties
/**
 * @SWG\Definition(
 *      definition = "player_creation",
 *      @SWG\Property(
 *          property="name",
 *          type="string",
 *          example="Mohamed Salah"
 *      ),
 *      @SWG\Property(
 *          property="player_position",
 *          type="string",
 *          example="GK"
 *      ),
 *     @SWG\Property(
 *          property="team_id",
 *          type="integer",
 *          example="5"
 *      ) ,
 *      @SWG\Property(
 *          property="country_id",
 *          type="integer",
 *          example="2"
 *      )
 * )

 */
class player extends Model
{
    //relationship between team and player
    // M player  --> 1 team    ===>  M to 1
    public function team(){
    	return $this->belongsTo(Team::class,'team_id');
    } 
    public function country()
    {
       return $this->belongsTo(Country::class,'country_id');
    }

    public function registeredPlayers()
    {
        return $this->hasMany(RegisteredPlayer::class);
    }
    //many players play in many seasons
    // M-M
    public function Seasons()
    {
    	return $this->belongsToMany(Season::class);
    }
}
