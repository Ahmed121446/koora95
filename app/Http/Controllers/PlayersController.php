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

}
