<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisteredTeamRequests;
use Illuminate\Http\Request;
use App\Http\Resources\RegisterTeamResource;
use App\Season;
use App\RegisteredTeam;

class RegisteredTeamsController extends Controller
{

	// Find All teams of a specific SEASON
	public function findAll(Season $season)
	{
		$teams = $season->registeredTeams;

		return response()->json([
			'data' => RegisterTeamResource::collection($teams)
		], 200);
	}


	// Retrieve a Team form Specific Season
	public function findById(Season $season, $team_id)
	{
		$team = $season->registeredTeams()->find($team_id);

		return response()->json([
			'data' =>new RegisterTeamResource($team)
		], 200);

	}

	
	// Add a Team to The Current Season
	public function create(Season $season, Request $request, RegisteredTeamRequests $teamRequest)
	{
		$team = $teamRequest->store($season);

		return response()->json([
			'data' =>new RegisterTeamResource($team)
		], 201);
	}


	// Update Team in The Current Season
	public function update(Season $season, $team_id, Request $request)
	{
		if(!$season->active){
			return response()->json(["message" => "Season is Ended"]);
		}

		$team = $season->registeredTeams()->find($team_id);
		$team->update($request->all());

		return response()->json([
			'data' =>new RegisterTeamResource($team)
		], 200);
	}

	// Delete a Team from The Current Season
	public function delete(Season $season, $team_id)
	{
		if(!$season->active){
			return response()->json(["message" => "Season is Ended"]);
		}
		$team = $season->registeredTeams()->find($team_id);
		$team->delete();

		return response()->json(['data' => "RegisterTeam deleted successfully"], 204);
	}
    
}
