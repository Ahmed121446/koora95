<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchRequest;

use Illuminate\Http\Request;
use App\Match;
use App\Season;
use App\Week;
use App\Round;
use App\Team;

class MatchesController extends Controller
{
    public function getSeasonMatches(Season $season)
    {
    	$matches = $season->matches;
     	return $matches;
    }


    public function addMatch(Season $season, MatchRequest $request)
    {
    	$match = $request->add($season);
    	return response()->json(['data' => $match],201);
    }


    public function update(Request $request, Season $season, Match $match){
    	$match = $season->matches()->find($match->id);

    	$match->update($request->all());
    	
    	return $match;
    }


    public function delete(Season $season,Match $match)
    {
    	$match = $season->matches()->find($match->id);
    	if (!$match->delete()) {
    		return response()->json([
    			'Message'=>'can not delete match'
    		],404);
    	}
    	return response()->json([
    			'Message'=>'match deleted successfully '
    	],204);
    }

    public function findByStage(Season $season, $stage_id)
    {
    	$stage = $season->stages()->find($stage_id);
    	$matches = $stage->matches;
    	return $matches;
    }

    public function Find_Date(Season $season,$date){


        $matches = $season->matches;
        $matchs = $matches->where('date',$date);
        if (!$matchs->first()) {
            return response()->json([
                'Message' => 'there is no matches in this date'
            ],404);
        }

        return response()->json([
                'Message' => 'found date',
                'matches on this date' => $matchs
            ],200); 
    }

    public function Find_Team_Matches(Season $season,Team $team){
        $team_in_season = $season->registeredTeams()->where('team_id',$team->id)->first();
        if (!$team_in_season) {
            return response()->json([
            'Message' =>'this team is not in this season'
           ],404);
        }
        
        $matches = $season->matches;
        $team_matches1 = $matches->where('register_team_1_id',$team->id);
        $team_matches2 = $matches->where('register_team_2_id',$team->id);
        $team_matches = $team_matches1->merge($team_matches2);
        if (!$team_matches->first()) {
           return response()->json([
            'Message' =>'there is not matches for this team'
           ],404);
        }else{
            return response()->json([
                'Message' =>'this team matches',
                'matches' => $team_matches
            ],200);
        }
    }

}
