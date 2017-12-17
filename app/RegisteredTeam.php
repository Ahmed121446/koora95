<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//for RegisteredTeam properties
/**
 * @SWG\Definition(
 *      definition = "RegisteredTeam_creation",
 *      @SWG\Property(
 *          property="team_id",
 *          type="integer",
 *          example=4
 *      )
 * )

 */

//test
/**
 * @SWG\Definition(
 *      definition = "RegisteredTeam_update",
 *      @SWG\Property(
 *          property="played",
 *          type="integer",
 *          example= 10
 *      ),
 *      @SWG\Property(
 *          property="wins",
 *          type="integer",
 *          example= 1
 *      ),
 *      @SWG\Property(
 *          property="losses",
 *          type="integer",
 *          example= 1
 *      ),
 *      @SWG\Property(
 *          property="draws",
 *          type="integer",
 *          example= 8
 *      ),
  *      @SWG\Property(
 *          property="goals_for",
 *          type="integer",
 *          example= 10
 *      ), 
 *      @SWG\Property(
 *          property="goals_against",
 *          type="integer",
 *          example= 1
 *      ),
 *      @SWG\Property(
 *          property="points",
 *          type="integer",
 *          example= 11
 *      ),
 *      @SWG\Property(
 *          property="red_cards",
 *          type="integer",
 *          example= 6
 *      ),
 *      @SWG\Property(
 *          property="yellow_cards",
 *          type="integer",
 *          example= 19
 *      )
 * )

 */
class RegisteredTeam extends BaseModel
{
    protected $fillable = ['team_id'];

    public function seasons()
    {
    	return $this->belongsTo(Season::class,'season_id');
    }

    public function team()
    {
       return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function registeredPlayers(){
    	return $this->hasMany(RegisteredPlayer::class);
    }

    public function storeTeamGolas($goals_for ,$goals_against){
    	$this->goals_for += $goals_for;
        $this->goals_against += $goals_against;
    }

    public function storeTeamCards($yellow_cards ,$red_cards){
        $this->yellow_cards += $yellow_cards;
        $this->red_cards += $red_cards;
       
    }


    
}
