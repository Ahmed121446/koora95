<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\team as Team;
use App\team_scope as TeamScope;

class TeamsController extends Controller
{

	// Create New Team 
    public function create()
    {
    	$continent = \App\continent::where('name', Request('continent'));
    	$country = \App\Country::where('name', Request('country'));
    	$scope = TeamScope::where('name', Request('scope'));

    	$team = Team::create([
    			'name' => Request('name'),
    			'continent_id' => $continent->id,
    			'country_id' => $country->id,
    			'team_scope_id' => $scope
    		]);

    	return response()->json(['data' => $team], 201);
    }


    // Find Team by its ID
    public function findById(Team $team)
    {
    	if(! $team){
    		return response()->json(['error' => 'Not Found'], 404);
    	}

    	return response()->json(['data' => $team], 200);
    }


    // Get Team Players
    public function teamPlayers()
    {
    	// $Team->players
    }

}
