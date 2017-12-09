<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompetitionRequest;

use Illuminate\Http\Request;
use App\Competition;
use App\CompetitionType;
use App\CompetitionScope;
use App\Country;
use App\continent;

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
    		return response()->json(['error' => 'competition not found']. 404);
    	}

    	return response()->json(['data' => $competition], 200);
    }

    // Create New Competition
    public function create(CompetitionRequest $request)
    {   
        $competition = $request->store();

    	return response()->json(['data' => $competition], 201);

    }


    // Update a Competition Data
    public function update(CompetitionRequest $request, Competition $competition)
    {
    	$competition = $request->update($competition);

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
