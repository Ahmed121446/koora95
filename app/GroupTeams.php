<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *      definition = "groupTeam",
 *      @SWG\Property(
 *          property="team_id",
 *          type="string",
 *          example=1
 *      ),
 * )
 */
class GroupTeams extends BaseModel
{
    public function group()
    {
    	return $this->belongsTo(Group::class);
    }

    public function registeredTeam()
    {
        return $this->belongsTo(RegisteredTeam::class,'register_team_id');
    }

    public function storeTeamGoals($goals_for ,$goals_against){
    	$this->goals_for += $goals_for;
        $this->goals_against += $goals_against;
    }

    public function storeTeamCards($yellow_cards ,$red_cards){
        $this->yellow_cards += $yellow_cards;
        $this->red_cards += $red_cards;
    }
}
