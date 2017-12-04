<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\competition as Competition;
use App\competition_type as CompetitionType;
use App\competition_scope as CompetitionScope;

class CompetitionsController extends Controller
{
	// Find All Competitions
    public function findAll()
    {
    	return response()->json(['data' => Competition::all(), 200]);
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

    	$type = CompetitionType::where('name', request('type'));
    	$scope = CompetitionScope::where('name', request('scope'));
    	
    	$competition =  Competition::create([
	    		'name' => request('name'),
	    		'competition_type_id' => $type->id;
	    		'competition_scope_id' => $scope->id;
	    	]);

    	response()->json(['data' => $competition], 201);

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




}
