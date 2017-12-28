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
    public function __construct(){
        $this->middleware('auth');
    }
    public function All_Players(Request $request){
            $countries = Country::all();
            $teams = Team::all();
        if ($request->has('name') || $request->has('team') || $request->has('position') ) {
            $name = $request->get('name');
            $team = $request->get('team');
            $position = $request->get('position');

            $resualt = player::where('name','LIKE',"{$name}%");
            if ($team == 1) {
               $resualt->where('team_id',0);
            }else if ($team == 2){
                $resualt->where('team_id','!=',0);
            }
            if ($request->has('position') && $position != "0"){
                $resualt->where('position',$position);
            }
            $all_players = $resualt->paginate(25)->appends('name',"{$name}")->appends('position',"{$position}");
        }else{
            $all_players = player::paginate(25);
        }
        return view('player.all_players',compact('all_players','countries','teams'));
        
    }
    public function Create_View(){
        //get player create.blade.php
        $Teams = Team::all();   
        $countries = Country::all(); 
        return view('player.create',compact('Teams','countries'));
    }

    public function create(CreatePlayerRequest $request){
        $request->store();
        return redirect('/');
    }



    public function Update_View($id){
        $player = player::find($id);
        if (!$player) {
            return response()->json([
                'Message' => 'no player found by this id.'
            ],404);
        } 
        return view('player.update',compact('player'));
    }


    public function autocomplete( Team $team, Request $request)
    {

        $term = $request->term;
    
        $results = array();

        $players = \DB::table('players')
                   ->where('team_id', $team->id)
                   ->where('name', 'LIKE', '%'.$term.'%')
                   ->get();

        foreach ($players as $player) 
        {
            $results[] = [ 'id' => $player->id, 'value' => $player->name ];
        }
        
        return \Response::json($results);

    }
    public function remove_player($id){
        $find_player = Player::find($id);
        $find_player->delete();
        return redirect()->back();
    }

    public function update($player_id,Request $request){
       $find_player = player::find($player_id);
        if(!$find_player){
            return  'player not found';
        }
        $find_player->name          = $request->get('player_name');
        $find_player->position       = $request->get('player_position');
        $find_player->team_id       = $request->get('team_id');
        $find_player->country_id    = $request->get('country_id');

        if (!$find_player->update()) {
            return "player can not be updated";
        }
        return "player updated successfully";
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
