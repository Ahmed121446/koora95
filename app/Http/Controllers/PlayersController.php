<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\player;
use App\Team;
use App\Country;
use App\Http\Requests\CreatePlayerRequest;




class PlayersController extends Controller
{
    public function Get_All_Players(){
    	$players = player::all();

    	if (!$players->first()) {
    		return response()->json([
    			'Message' => 'No player found'
    		],404);
    	}

    	return response()->json([
    			'Message' => 'Found Players',
    			'players data and information' => $players->toArray()
    	],404);
    }
    public function Get_Player($id){
    	$player = player::find($id);

    	if (!$player) {
    		return response()->json([
    			'Message' => 'No player found'
    		],404);
    	}

    	return response()->json([
    			'Message' => 'Found player',
    			'player data and information' => $player->toArray()
    	],404);
    }
    public function Get_Player_Create_View(){
    	//get player create.blade.php
    	$Teams = Team::all();   
    	$countries = Country::all(); 
    	
    	return view('player.create',compact('Teams','countries'));
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
			'player_Data' => $player->toArray() 
		],200);
	}
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
				'player_Information' => $player->toArray()
			],409);
		}
		return response()->json([
			'Message' => 'This player updated successfully congrats',
			'player_Information' => $player->toArray()
		],200); 
	}
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
			'Message' => ' player is deleted successfully '
		],200);
	}

}
