<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competition;
use App\CompetitionType;
use App\CompetitionScope;

class CompetitionsController extends Controller
{
	// Find All Competitions
    public function findAll()
    {
    	return response()->json(['data' => Competition::all()], 200);
    }

    //Find Competition By its ID
    public function findById(Competition $competition){

    	if(! $competition){
    		return response()->json(['error' => 'competition not found']);
    	}

    	return response()->json(['data' => $competition], 200);
    }

    // Create New Competition
    public function create(){

    	$type = CompetitionType::where('name', Request('type'))->first();

    	$scope = CompetitionScope::where('name', Request('scope'))->first();
    	
    	$competition =  new Competition([
	    		'name' => Request('name'),
	    		'comp_type_id' => $type->id,
	    		'comp_scope_id' => $scope->id
	    	]);

        $competition->save();

        // $season = new Season([
        //         'season_year' => Request('season')
        //     ]);

        // $competition->seasons()->save($season);

    	return response()->json(['data' => $competition], 201);

    }


    // Update a Competition Data
    public function update(Request $request, Competition $competition)
    {
    	$competition->update($request->all());

    	response()->json(['data' => $competition], 200);
    }

    // Delete a Competition
    public function delete(Competition $competition)
    {
    	$competition->delete();

    	response()->json(['data' => null], 204);
    }


    // Find Competitions Teams 
    public function findTeams(Competition $competition)
    {
    	$teams = $competition->teams;

        return response()->json(['data' => $teams], 200);
    }


    // Add Team To Competition 
    public function addTeam(Competition $competition, Team $team)
    {
    	$team = $competition->teams()->attach($team);

        return response()->json(['data' => $team], 200);
    }


    // Delete Team From Competition
    public function deleteTeam(Competition $competition, Team $team)
    {
    	$competition->teams()->detach($team);

        return response()->json(null, 200);
    }


}
