<?php

namespace App\Repositories;

use App\Group;
use App\GroupTeams;

/**
* 
*/
class Groups
{
	
	public function addGroupTeams(Group $group, $team_id)
    {
        $team = new GroupTeams([
            'register_team_id' => $team_id, 
            'played' => 0, 
            'wins'=> 0, 
            'losses' => 0, 
            'draws' => 0, 
            'goals_for' => 0, 
            'goals_against' => 0,
            'points' => 0,
            'red_cards' => 0,
            'yellow_cards' => 0

        ]);

        $team = $group->groupTeams()->save($team);

        if(!$team){
            return response()->json(['message' => 'An Error Occured'], 500);
        }

        return response()->json(['data' => $team], 201);
    }


}