<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompetitionRequest;

use Illuminate\Http\Request;
use App\Competition;
use App\Http\Resources\CompetitionResource;

class CompetitionsController extends Controller
{
	// Find All Competitions
    public function findAll()
    {
        $competitions = Competition::all();

        if(!$competitions->first()){
            return response()->json(['message' => 'There is No Competitions' ], 404);
        }

    	return response()->json([
            'data' => CompetitionResource::collection( $competitions)
        ], 200);
    }


    //Find Competition By its ID
    public function findById(Competition $competition){
    	return response()->json([
            'data' =>new CompetitionResource( $competition)
        ], 200);
    
    }

    // Create New Competition
    public function create(CompetitionRequest $request)
    {   
        $competition = $request->store();

    	return response()->json([
            'data' =>new CompetitionResource( $competition)
        ], 201);

    }


    // Update a Competition Data
    public function update(CompetitionRequest $request, Competition $competition)
    {
    	$competition = $request->update($competition);

    	response()->json([
            'data' =>new CompetitionResource($competition)
        ], 200);
    }

    // Delete a Competition
    public function delete(Competition $competition)
    {
    	if(! $competition->delete()){
            return response()->json(['message' => 'an error occured'], 500);
        }

    	response()->json(['data' => "Competition deleted successfully"], 204);
    }

}
