<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RegisterPlayerResource;
use App\Season;
use App\RegisteredTeam;
use App\RegisteredPlayer;
use App\player;
use App\Competition;

use App\Http\Requests\AddRegisteredPlayerRequest;




class RegisteredPlayersController extends Controller
{
    // Find All registeredplayers of a specific registeredteam
    /**
     * @SWG\Get(
     *     path="/api/Seasons/{season_id}/RegisteredTeam/{team_id}/RegisteredPlayer/players",
     *     description = "get all registered Players in a team",
     *     produces={"application/json"},
     *     operationId="AllPlayers",
     *     tags={"Registered Players"},
     *     @SWG\Parameter(
     *          name="season_id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Season ID",
     *      ),
     *     @SWG\Parameter(
     *          name="team_id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Team ID",
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
    public function findAll(Season $season , RegisteredTeam $team){
        $team       = $season->registeredTeams()->find($team)->first();
        $players    = $team->registeredPlayers;
        return response()->json([
            'players_data_in_team' => RegisterPlayerResource::collection($players)
        ], 200);
    }


    // Retrieve a Team form Specific Season
    /**
     * @SWG\Get(
     *     path="/api/Seasons/{season_id}/RegisteredTeam/{team_id}/RegisteredPlayer/{id}",
     *     description = "get singe team player",
     *     produces={"application/json"},
     *     operationId="findPlayer",
     *     tags={"Registered Players"},
     *     @SWG\Parameter(
     *          name="season_id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Season ID",
     *      ),
     *     @SWG\Parameter(
     *          name="team_id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Team ID",
     *      ),
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="player ID",
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
    public function findById(Season $season,RegisteredTeam $team ,$player){
        $team       = $season->registeredTeams()->find($team)->first();
        $player     = $team->registeredPlayers()->find($player);
        return response()->json([
            'player_data' =>new RegisterPlayerResource($player)
        ], 200);
    }


    /**
     *   @SWG\Post(
     *     path="/api/Seasons/{season_id}/RegisteredTeam/{team_id}/RegisteredPlayer/Create",
     *     description = "add Player to team",
     *     produces={"application/json"},
     *     operationId="addPlayer",
     *     tags={"Registered Players"},
     *     @SWG\Parameter(
     *          name="season_id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Season ID",
     *      ),
     *     @SWG\Parameter(
     *          name="team_id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Team ID",
     *      ),
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          schema={"$ref":"#/definitions/registeredPlayer"},
     *      ),
     *      @SWG\Response(
     *         response = 201,
     *         description = "SUCCESSFULLY CREATED"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     *     
     * )
     */
    public function Add_Player_In_RegisteredTeam(AddRegisteredPlayerRequest $request , Season $season,RegisteredTeam $team)
    {    
        
        $player = $request->addPlayer($season, $team);

        return response()->json([
            'Message' => 'player added successfully',
            'data' =>new RegisterPlayerResource( $player )
        ], 201);
    
    }

    

    /**
     *   @SWG\Put(
     *     path="/api/Seasons/{season_id}/RegisteredTeam/{team_id}/RegisteredPlayer/{id}/update",
     *     description = "update player",
     *     produces={"application/json"},
     *     operationId="updatePlayer",
     *     tags={"Registered Players"},
     *     @SWG\Parameter(
     *          name="season_id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Season ID",
     *      ),
     *     @SWG\Parameter(
     *          name="team_id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Team ID",
     *      ),
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="player ID",
     *      ), 
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Property(
     *              property="goals",
     *              type="integer",
     *              description="scored Goals",
     *              example="1"
     *          ),
     *      ),
     *      @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY UPDATED"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     *     
     * )
     */
    public function Update_Player_From_RegisteredTeam(Season $season, RegisteredTeam $team, $player, Request $request)
    {

        $team = $season->registeredTeams()->find($team->id);
        $player = $team->registeredPlayers()->find($player);
        
       if (!$player->update($request->all())) {
           return response()->json([
            'Message' => 'can not update player'
            ],400);
       }

       return response()->json([
            'Message' => ' update player successfully',
            'player_new_information' =>new RegisterPlayerResource($player)
        ],200); 
    }



    /**
     *   @SWG\Delete(
     *     path="/api/Seasons/{season_id}/RegisteredTeam/{team_id}/RegisteredPlayer/{id}",
     *     description = "Delete player",
     *     produces={"application/json"},
     *     operationId="deletePlayer",
     *     tags={"Registered Players"},
     *     @SWG\Parameter(
     *          name="season_id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Season ID",
     *      ),
     *     @SWG\Parameter(
     *          name="team_id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Team ID",
     *      ),
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="player ID",
     *      ), 
     *      @SWG\Response(
     *         response = 204,
     *         description = "SUCCESSFULLY Deleted"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     *     
     * )
     */
    public function Delete_Player_From_RegisteredTeam( Season $season,RegisteredTeam $team ,$player){
        $team = $season->registeredTeams()->find($team)->first();
        $player = $team->registeredPlayers()->find($player);

        if (!$player->delete()) {
            return response()->json([
                'Message' => ' player Cannot be deleted X-X'
            ],401);
        }
        return response()->json([
            'Message' => ' player is deleted successfully '
        ],204);
    }

}
