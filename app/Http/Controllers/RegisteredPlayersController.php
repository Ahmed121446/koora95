<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\RegisteredTeam;
use App\RegisteredPlayer;


class RegisteredPlayersController extends Controller
{
    // Find All registeredplayers of a specific registeredteam
    public function findAll(Season $season , RegisteredTeam $team){
        $team       = $season->registeredTeams()->find($team)->first();
        $players    = $team->registeredPlayers;
        return response()->json([
            'players_data_in_team' => $players
        ], 200);
    }

    // Retrieve a Team form Specific Season
    public function findById(Season $season,RegisteredTeam $team ,$player){
        $team       = $season->registeredTeams()->find($team)->first();
        $player     = $team->registeredPlayers()->find($player);
        return $player ;
    }

    public function Add_Player_In_RegisteredTeam(Request $request , Season $season,RegisteredTeam $team){
        $this->validate($request,[
            'registered_team_id' => 'required|numeric',
            'player_id' => 'required|numeric'
        ]);

        $registered_team_id     = $request->get('registered_team_id');
        $player_id              = $request->get('player_id');
        $played                 =0;
        $goals                  =0;
        $assists                =0;
        $red_cards              =0;
        $yellow_cards           =0;

        $registered_player = new RegisteredPlayer();
        $registered_player->registered_team_id  = $registered_team_id;
        $registered_player->player_id           = $player_id;
        $registered_player->played              = $played;
        $registered_player->goals               = $goals;
        $registered_player->assists             = $assists;
        $registered_player->red_cards           = $red_cards;
        $registered_player->yellow_cards        = $yellow_cards;


        $team       = $season->registeredTeams()->find($team)->first();
        $player     = $team->registeredPlayers()->save($registered_player);

        return response()->json([
            'Message' => 'player added successfully',
            'data' => $player 
        ], 201);
    }

    public function Update_Player_From_RegisteredTeam(Request $request , Season $season,RegisteredTeam $team,$player){
        $this->validate($request,[
            'registered_team_id' => 'required|numeric',
            'player_id' => 'required|numeric',
            'played' => 'required|numeric',
            'goals' => 'required|numeric',
            'assists' => 'required|numeric',
            'red_cards' => 'required|numeric',
            'yellow_cards' => 'required|numeric'
        ]);

        $team       = $season->registeredTeams()->find($team)->first();
        $player     = $team->registeredPlayers()->find($player);


       $player->registered_team_id     = $request->get('registered_team_id');
       $player->player_id              = $request->get('player_id');
       $player->played                 = $request->get('played');
       $player->goals                  = $request->get('goals');
       $player->assists                = $request->get('assists');
       $player->red_cards              = $request->get('red_cards');
       $player->yellow_cards           = $request->get('yellow_cards');

        
       if (!$player->update()) {
           return response()->json([
            'Message' => 'can not update player'
            ],400);
       }

       return response()->json([
            'Message' => ' update player successfully',
            'player_new_information' =>$player
        ],200); 

        
       
    }

    public function Delete_Player_From_RegisteredTeam( Season $season,RegisteredTeam $team ,$player){
        $team       = $season->registeredTeams()->find($team)->first();
        $player     = $team->registeredPlayers()->find($player);

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
