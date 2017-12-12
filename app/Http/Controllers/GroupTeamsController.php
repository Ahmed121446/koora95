<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Season;
use App\Group;
use App\Group_Teams;


class GroupTeamsController extends Controller
{

    public function get_All_Teams_In_Specific_Group(Season $season ,Group $group){
    	$Find_Group_In_Season = $season->groups()->where('name',$group->name)->first();
    	$This_Group = $Find_Group_In_Season->Group_Teams;

    	if (!$This_Group->count()) {
    		return response()->json([
    			'Message' => 'no teams in this group'
    		],404);
    	}
    	return response()->json([
    			'Message' => 'this group contain teams',
    			'Teams' => $This_Group
    	],200);
    }

    public function get_Team_In_Specific_Group(Season $season ,Group $group , Group_Teams $team){

    	$Find_Group_In_Season = $season->groups()->where('name',$group->name)->first();
    	$Find_Team_In_Group = $Find_Group_In_Season->Group_Teams()->where('register_team_id',$team->id)->first();

    	if (!$Find_Team_In_Group) {
    		return response()->json([
	            'Message' => 'this team is not in this group'
	        ], 404);
    	}

    	return response()->json([
            'Message' => 'this team is found successfully',
            'Team information' => $Find_Team_In_Group
        ], 200);
    }

    public function Add_Team_In_Group(Season $season , Group $group ,Request $request){

    	$registered_team_id     = $request->get('registered_team_id');

    	$New_Team = new Group_Teams();
    	$New_Team->register_team_id = $registered_team_id;


    	$Find_Group_In_Season = $season->groups()->where('name',$group->name)->first();

    	if ($team_added = !$Find_Group_In_Season->Group_Teams()->save($New_Team)) {
    		return response()->json([
	            'Message' => 'can not save this team'
        	], 401);
    	}

    	return response()->json([
            'Message' => 'team added successfully',
            'data' => $New_Team 
        ], 201);
    }

    public function Delete_Team_From_Group(Season $season , Group $group ,Group_Teams $team){

    	$Find_Group_In_Season = $season->groups()->where('name',$group->name)->first();
    	$Find_Team_In_Group = $Find_Group_In_Season->Group_Teams()->where('register_team_id',$team->id)->first();

    	if (!$Find_Team_In_Group) {
    		return response()->json([
	            'Message' => 'no team in this group'
	        ], 404);
    	}

    	if (!$Find_Team_In_Group->delete()) {
    		return response()->json([
	            'Message' => 'this team can not be deleted'
	        ], 404);
    	}

    	return response()->json([
            'Message' => 'this team is deleted successfully'
        ], 201);
    }

}
