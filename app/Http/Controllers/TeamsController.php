<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\TeamScope;

class TeamsController extends Controller
{

	// Create New Team 
    public function create()
    {
    	$continent = \App\continent::where('name', Request('continent'))->first();
    	$country = \App\Country::where('name', Request('country'))->first();
    	$scope = TeamScope::where('name', Request('scope'))->first();

        // return $continent->id . "   " . $country->id . "  " . $scope->id; 

    	$team = Team::create([
    			'name' => Request('name'),
    			'continent_id' => $continent->id,
    			'country_id' => $country->id,
    			'team_scope_id' => $scope->id
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
