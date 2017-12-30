<?php

namespace App\Http\Controllers;

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
    public function __construct(){
        $this->middleware('auth');
    }
    public function add(Competition $competition, Season $season, RegisteredTeam $team, AddRegisteredPlayerRequest $request)
    {
        $player = $request->addPlayer();

        $team = $season->registeredTeams()->find($team)->first();
        $player = $team->registeredPlayers()->save($player);

        return redirect()->back();
    }

}
