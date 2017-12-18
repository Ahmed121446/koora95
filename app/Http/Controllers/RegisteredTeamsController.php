<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisteredTeamRequests;
use Illuminate\Http\Request;
use App\Http\Resources\RegisterTeamResource;
use App\Season;
use App\RegisteredTeam;

class RegisteredTeamsController extends Controller
{
	//get all Registered Teams swagger
	/**
     * @SWG\Get(
     *     path="/api/Seasons/{season}/RegisteredTeam/teams",
     *     description = "get all Registered Teams in specific season",
     *     produces={"application/json"},
     *     operationId="GET_ALL_RegisteredTeams",
     *     tags={"RegisteredTeam"},
     *     @SWG\Parameter(
     *          name="season",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="season ID",
     *      ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY DONE"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     * )
     */
	// Find All teams of a specific SEASON
	public function findAll(Season $season)
	{
		$teams = $season->registeredTeams;

		return response()->json([
			'data' => RegisterTeamResource::collection($teams)
		], 200);
	}

	//Get Registered Teams swagger
    /**
     * @SWG\Get(
     *     path="/api/Seasons/{season}/RegisteredTeam/{team_id}",
     *     description = "get Registered Team in specific season with it's id and season id",
     *     produces={"application/json"},
     *     operationId="GET_RegisteredTeam",
     *     tags={"RegisteredTeam"},
     *     @SWG\Parameter(
     *          name="season",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="season ID",
     *      ),
     *     @SWG\Parameter(
     *          name="team_id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="team ID",
     *      ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY DONE"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     * )
     */
	// Retrieve a Team form Specific Season
	public function findById(Season $season, $team_id)
	{
		$team = $season->registeredTeams()->find($team_id);

		return response()->json([
			'data' =>new RegisterTeamResource($team)
		], 200);

	}

    //create Register Team
    /**
     *   @SWG\Post(
     *     path="/api/Seasons/{season}/RegisteredTeam/teams",
     *     description = "post Create RegisteredTeam form ",
     *     produces={"application/json"},
     *     operationId="POST_Create_RegisteredTeam",
     *     tags={"RegisteredTeam"},
     *     @SWG\Parameter(
     *          name="season",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="season ID",
     *      ),
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          schema={"$ref": "#/definitions/RegisteredTeam_creation"},
     *          required=true
     *      ),
     *      @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY DONE"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     *     
     * )
     */
	
	// Add a Team to The Current Season
	public function create(Season $season, Request $request, RegisteredTeamRequests $teamRequest)
	{
		$team = $teamRequest->store($season);

		return response()->json([
			'data' =>new RegisterTeamResource($team)
		], 201);
	}

	// put update Register Team  swagger
    /**
     *   @SWG\Put(
     *     path="/api/Seasons/{season}/RegisteredTeam/update-team/{team_id}",
     *     description = "put request for update RegisteredTeam",
     *     produces={"application/json"},
     *     operationId="PUT_UPDATE_RegisteredTeam",
     *     tags={"RegisteredTeam"},
     *
     *      @SWG\Parameter(
     *          name="season",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="season id",
     *      ),
     *      @SWG\Parameter(
     *          name="team_id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="Registered Team id",
     *      ),
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          schema={"$ref": "#/definitions/RegisteredTeam_update"},
     *          required=true
     *      ),
     *      @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY DONE"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     *     
     * )
     */
	// Update Team in The Current Season
	public function update(Season $season, $team_id, Request $request)
	{
		if(!$season->active){
			return response()->json(["message" => "Season is Ended"]);
		}

		$team = $season->registeredTeams()->find($team_id);
		$team->played = $request->get('played');
		$team->wins = $request->get('wins');
		$team->losses = $request->get('losses');
		$team->draws = $request->get('draws');
		$team->goals_for = $request->get('goals_for');
		$team->goals_against = $request->get('goals_against');
		$team->points = $request->get('points');
		$team->red_cards = $request->get('red_cards');
		$team->yellow_cards = $request->get('yellow_cards');
		$team->update();

		return response()->json([
			'data' =>new RegisterTeamResource($team)
		], 200);
	}


	//delete Register Team swagger
    /**
     *  @SWG\Delete(
     *      path="/api/Seasons/{season}/RegisteredTeam/delete-team/{team_id}",
     *      tags={"RegisteredTeam"},
     *      operationId="deleteRegisterTeam",
     *      summary="Remove RegisteredTeam from database",
     *      
     *      @SWG\Parameter(
     *          name="season",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="season ID",
     *      ),   
     *      @SWG\Parameter(
     *          name="team_id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="Registered Team ID",
     *      ),   
     *      @SWG\Response(
     *          response = 200,
     *          description="success",
     *      ),
     *      @SWG\Response(
     *          response = 401,
     *          description="error",
     *      )
     *  )
     *
     */
	// Delete a Team from The Current Season
	public function delete(Season $season, $team_id)
	{
		if(!$season->active){
			return response()->json(["message" => "Season is Ended"]);
		}
		$team = $season->registeredTeams()->find($team_id);
		$team->delete();

		return response()->json(['data' => "RegisterTeam deleted successfully"], 200);
	}
    
}
