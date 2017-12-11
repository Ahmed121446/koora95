<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use App\Season;
use App\Week;
use App\Round;

class MatchesController extends Controller
{
    public function getSeasonMatches(Season $season)
    {
     	$matches = Match::all();
     	return $matches;
    }


    public function addMatch(Season $season, Request $request)
    {
    	if($request->get('week_id')) {
            $week_id = $request->get('week_id');
            $stage = Week::find($week_id);
        }else{
            $round_id = $request->get('round_id');
            $stage = Round::find($round_id);
        }
        $match =  new Match([
        	'date'  => $request->get('date'),
        	'register_team_1_id' => $request->get('register_team_1_id'),
			'register_team_2_id' => $request->get('register_team_2_id'),
			'stadium' => $request->get('stadium'),
			'team_1_goals' => $request->get('team_1_goals'),
			'team_2_goals' => $request->get('team_2_goals'),
			'red_cards' => $request->get('red_cards'),
			'yellow_cards' => $request->get('yellow_cards')
        ]);

        $stage->matches()->save($match);

        $season->matches()->save($match);

    	return $match;
    }


    public function update(Request $request, Season $season, Match $match)
    {
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

}
