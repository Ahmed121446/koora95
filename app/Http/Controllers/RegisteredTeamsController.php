<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisteredTeamRequests;
use Illuminate\Http\Request;
use App\Http\Resources\RegisterTeamResource;
use App\Season;
use App\Competition;
use App\RegisteredTeam;
use App\player;

class RegisteredTeamsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
     public function show(Competition $Competition,Season $season ,RegisteredTeam $team)
    {
       
        $team_players = $team->registeredPlayers;
        // return $team_players;

        return view('registeredTeam.show', compact(['team','team_players']));
        // return view('registeredTeam.specific_RegisteredTeam',compact('teams'));
    }

    public function addTeams(Competition $competition, Season $season, RegisteredTeamRequests $teamRequest)
     {
          $teamRequest->store($season);

          return redirect()->back();

     }
     
}
