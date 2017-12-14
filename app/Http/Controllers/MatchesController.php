<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchRequest;

use App\Repositories\Matches as MatchesRepo;
use App\Http\Resources\MatchResource  ;

use Illuminate\Http\Request;
use App\Match;
use App\Season;
use App\Team;
use Carbon\Carbon;
use App\RegisteredTeam;


class MatchesController extends Controller
{
    // Return All Season Matches
    public function getSeasonMatches(Season $season)
    {
    	if(!$season->id){
    		return response()->json(['message' => 'Season Not Found'], 404);
    	}

    	$matches = $season->matches;
     	return response()->json([
            'data' => MatchResource::collection($matches)
        ], 200);
    }


    // Add Match to The Season
    public function addMatch(Season $season, MatchRequest $request)
    {
    	if(!$season->active){
    		return response()->json(['message' => 'Season is inactive'], 404);
    	}
    	$match = $request->add($season);
    	return response()->json([
            'data' =>new MatchResource($match)
        ],201);
    }



    public function update(Request $request, Season $season, Match $match)
    {
        
    	if(!$season->active){
    		return response()->json(['message' => 'Season is inactive'], 404);
    	}

    	$match = $season->matches()->find($match->id);

    	$match->update($request->all());
    	
    	return response()->json([
            'data' => new MatchResource($match)
        ],201);
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
    	return response()->json([
            'data' => MatchResource::collection($matches)
        ],201);
    }



    public function findInGroupStage(Season $season, $stage_id, $round_number)
    {
        $stage = $season->stages()->find($stage_id);
        $groups = $stage->groups; 
        
        if(!$groups->first()){
            return response()->json(['message' => 'There is no Groups'], 404);
        }
        
        
        $matches = $round->matches;
        return response()->json([
            'data' => MatchResource::collection($matches)
        ],201);
    }



    // Find matches in Specific Date through a season
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
                'matches on this date' => MatchResource::collection($matchs)
            ],200); 
    }


    // Find all Matches of a single team in a specific season
    public function Find_Team_Matches(Season $season,RegisteredTeam $team)
    {
        $team_in_season = $season->registeredTeams()->find($team->id)->first();
        if (!$team_in_season) {
            return response()->json([
            'Message' =>'this team is not in this season'
           ],404);
        }
        
        $matches = $season->matches();
        $team_matches = $matches->where('register_team_1_id',$team->id)
                                ->orWhere('register_team_2_id',$team->id)
                                ->get();

           // dd($team_matches->get());
        if (!$team_matches->count()) {
           return response()->json([
            'Message' =>'there is not matches for this team'
           ],404);
        }else{
            return response()->json([
                'Message' =>'this team matches',
                'matches' => MatchResource::collection($team_matches)
            ],200);
        }
    }



    // All matches in a given date through all competitions
    public function findAllByDate($date)
    {
    	$matches = Match::where('date',$date)->get();

        if (!$matches->first()) {
            return response()->json([
                'Message' => 'there is no matches in this date'
            ],404);
        }

        return response()->json([
                'data' =>  MatchResource::collection($matches)
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
                'data' => MatchResource::collection($matches)
            ],200);
    }

    public function Matches_InProgressed_state(Season $season)
    {
        if (!$season->active) {
            return response()->json([
                'Message' => 'this season is not in active mood'
            ],404);
        }
        $match = $season->matches()->where('status' , 'In Progress')->get();
        if (!$match->count()) {
            return response()->json([
                'Message' => 'no matches in Progress in this season now'
            ],404);
        }
        return response()->json([
                'Matches' => MatchResource::collection($match)
        ],200);
    }



    public function confirmResult(Season $season, Match $match, MatchesRepo $matchRepo)
    {

        $match_goals = [
            'first_team_goals' => Request('first_team_goals'),
            'second_team_goals' => Request('second_team_goals')
        ];

        $match_cards = [
            'first_team_cards' => [
               'first_team_yellow_cards' => Request('first_team_yellow_cards'),
               'first_team_red_cards' => Request('first_team_red_cards')
            ],
            'second_team_cards' => [
               'second_team_yellow_cards' => Request('second_team_yellow_cards'),
               'second_team_red_cards' => Request('second_team_red_cards')
            ]
        ];

        $matchRepo->confirm($season, $match, $match_goals,$match_cards);
    }

}
