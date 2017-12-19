<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\player;
use App\Team;
use App\Country;
use App\Http\Requests\CreatePlayerRequest;
use App\Http\Resources\PlayerResource;

class PlayersController extends Controller
{
    public function createView(){
        //get player create.blade.php
        $Teams = Team::all();   
        $countries = Country::all(); 
        
        return view('player.create',compact('Teams','countries'));
    }


    
	//get all players
    /**
     * @SWG\Get(
     *     path="/api/Players/All-Players",
     *     description = "get all Players",
     *     produces={"application/json"},
     *     operationId="GET_ALL_Teams",
     *     tags={"Player"},
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
    public function Get_All_Players(){
    	$players = player::all();

    	if (!$players->first()) {
    		return response()->json([
    			'Message' => 'No player found'
    		],404);
    	}

    	return response()->json([
    			'Message' => 'Found Players',
    			'players data and information' => PlayerResource::collection($players)
    	],200);
    }

    //Get player swagger
    /**
     * @SWG\Get(
     *     path="/api/Players/{id}",
     *     description = "get Players with it's id",
     *     produces={"application/json"},
     *     operationId="GET_Player",
     *     tags={"Player"},
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="Player ID",
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
    public function Get_Player($id){
    	$player = player::find($id);

    	if (!$player) {
    		return response()->json([
    			'Message' => 'No player found'
    		],404);
    	}

    	return response()->json([
    			'Message' => 'Found player',
    			'player data and information' =>new PlayerResource( $player)
    	],200);
    }
    

    public function Get_Player_Update_View($id){
		$player = player::find($id);
		if (!$player) {
			return response()->json([
				'Message' => 'no player found by this id.'
			],404);
		} 
		return view('player.update',compact('player'));
	}


    //create player
    /**
     *   @SWG\Post(
     *     path="/api/Players/Create",
     *     description = "post Create Player form ",
     *     produces={"application/json"},
     *     operationId="POST_Create_Player",
     *     tags={"Player"},
     *
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          schema={"$ref": "#/definitions/player_creation"},
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
	public function Create_Player(CreatePlayerRequest $request){

		$name = $request->input('name');
		$player_position = $request->input('player_position');
		$team_id = $request->input('team_id');
		$country_id = $request->input('country_id');


		$player = new player();
		$player->name = $name;
		$player->position = $player_position;
		$player->team_id = $team_id;
		$player->country_id = $country_id;


		if (!$player->save()) {
			return response()->json([
				'Message' => 'player cannot be created'
			],400);
		}

		return response()->json([
			'Message' => 'player is created successfully',
			'player_Data' =>new PlayerResource( $player) 
		],200);
	}

    // put update player  swagger
    /**
     *   @SWG\Put(
     *     path="/api/Players/Update/{id}",
     *     description = "put request for update Player name",
     *     produces={"application/json"},
     *     operationId="PUT_UPDATE_Player_name",
     *     tags={"Player"},
     *
     *      @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="UUID",
     *      ),
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          schema={"$ref": "#/definitions/player_creation"},
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
	public function Update_Player(Request $request , $id){
		$player = player::find($id);
		if (!$player) {
			return response()->json([
				'Message' => ' player not found'
			],404);
		} 

		$player->name = $request->get('name');
		$player->position = $request->get('player_position');

		if (!$player->update()) {
			return response()->json([
				'Message' => 'This player Can Not be updated',
				'player_Information' =>new PlayerResource( $player)  
			],409);
		}
		return response()->json([
			'Message' => 'This player updated successfully congrats',
			'player_Information' => new PlayerResource( $player) 
		],200); 
	}


    //delete player swagger
    /**
     *  @SWG\Delete(
     *      path="/api/Players/{id}",
     *      tags={"Player"},
     *      operationId="deleteplayer",
     *      summary="Remove player from database",
     *      
     *      @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="player ID",
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
	public function destroy($id){
		$player = player::find($id);

		if (!$player) {
			return response()->json([
				'Message' => ' player not found'
			],404);
		}

		if (!$player->delete()) {
			return response()->json([
				'Message' => ' player Cannot be deleted X-X'
			],401);
		}

		return response()->json([
			'Message' => $player->name.' player is deleted successfully '
		],200);
	}

}
