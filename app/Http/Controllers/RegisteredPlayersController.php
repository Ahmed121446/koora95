<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\Team;


class RegisteredPlayersController extends Controller
{
    public function Get_All_Players_In_Regiesterd_Teams($Season ,$team){
    	$Season = Season::find($Season);
    	if (!$Season) {
    		return response()->json([
    			'Message' => 'this season is not found'
    		],404);
    	}

    	$team = Team::find($team);
    	if (!$team) {
    		return response()->json([
    			'Message' => 'this team is not found'
    		],404);
    	}
    }
}
