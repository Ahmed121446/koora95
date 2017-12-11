<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchRequest;

use Illuminate\Http\Request;
use App\Match;
use App\Season;
use App\Week;
use App\Round;

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

    public function findByStage(Season $season, $stage_id)
    {
    	$stage = $season->stages()->find($stage_id);
    	$matches = $stage->matches;
    	return $matches;
    }

}
