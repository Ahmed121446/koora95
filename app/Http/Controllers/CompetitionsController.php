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

        // $competition->seasons()->save($season);

        $competition->save();

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
    public function findTeams()
    {
    	// Competitions->teams
    }


    // Add Team To Competition 
    public function addTeam()
    {
    	// Competition->addTeam(Team)
    }


    // Delete Team From Competition
    public function deleteTeam($value='')
    {
    	// Competition->deleteTeam(Team)
    }


}
