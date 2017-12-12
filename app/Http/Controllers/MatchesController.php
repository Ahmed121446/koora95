<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchRequest;

use Illuminate\Http\Request;
use App\Match;
use App\Season;
use App\Team;
use Carbon\Carbon;

class MatchesController extends Controller
{
    public function getSeasonMatches(Season $season)
    {
    	if(!$season->id){
    		return response()->json(['message' => 'Season Not Found'], 404);
    	}

    	$matches = $season->matches;
     	return response()->json(['data' => $matches], 200);
    }



    public function addMatch(Season $season, MatchRequest $request)
    {
    	if(!$season->active){
    		return response()->json(['message' => 'Season is inactive'], 404);
    	}
    	$match = $request->add($season);
    	return response()->json(['data' => $match],201);
    }



    public function update(Request $request, Season $season, Match $match)
    {

    	if(!$season->active){
    		return response()->json(['message' => 'Season is inactive'], 404);
    	}

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



    public function Find_Date(Season $season,$date)
    {
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



    public function Find_Team_Matches(Season $season,Team $team)
    {
        $team_in_season = $season->registeredTeams()->where('team_id',$team->id)->first();
        if (!$team_in_season) {
            return response()->json([
            'Message' =>'this team is not in this season'
           ],404);
        }
        
        $matches = $season->matches();
        $team_matches = $matches
            ->where('register_team_1_id',$team->id)
            ->orWhere('register_team_2_id',$team->id)->get();

           // dd($team_matches->get());
        if (!$team_matches->count()) {
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



    public function findAllByDate($date)
    {
    	$matches = Match::where('date',$date)->get();

        if (!$matches->first()) {
            return response()->json([
                'Message' => 'there is no matches in this date'
            ],404);
        }

        return response()->json([
                'data' => $matches
            ],200); 
    }



    public function todayMatches()
    {
    	$today = Carbon::now();
    	$today = $today->toDateString();


    	$matches = Match::where('date',$today)->get();

        if (!$matches->first()) {
            return response()->json([
                'Message' => 'there is no matches in this date'
            ],404);
        }

        return response()->json([
                'data' => $matches
            ],200);
    }



    public function confirmResult(Season $season, Match $match, Request $request)
    {
        $is_cup = $season->competition()->is_cup(); // T or F

        $first_team = $match->register_team_1_id;
        $second_team = $match->register_team_2_id;

        $first_team = $season->registeredTeams()->find($first_team);
        $second_team = $season->registeredTeams()->find($second_team);

        $first_team_goals = $request->get('first_team_goals');
        $second_team_goals = $request->get('second_team_goals');

        //to match model
        $match->match_played($first_team,$second_team);
        
        $match->match_winner($first_team_goals,$second_team_goals, $is_cup);

        $match->calculate_goals($first_team_goals,$second_team_goals);
        
        //to register team  model
        $first_team->calculate_goals($first_team_goals,$second_team_goals);
        $second_team->calculate_goals($second_team_goals,$first_team_goals);
      
        $match->save();
        $first_team->save();
        $second_team->save();
    }

}
