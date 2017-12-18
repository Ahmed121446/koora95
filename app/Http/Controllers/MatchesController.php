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

    //get all matches in specific season swagger
    /**
     * @SWG\Get(
     *     path="/api/Seasons/{season}/Event/matches",
     *     description = "get all matches in specific season",
     *     produces={"application/json"},
     *     operationId="GET_ALL_matches",
     *     tags={"Match"},
     *     @SWG\Parameter(
     *          name="season",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="season ID",
     *      ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY DONE"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     * )
     */
    
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

    //create new match
    /**
     *   @SWG\Post(
     *     path="/api/Seasons/{season}/Event/matches",
     *     description = "post Create matche form ",
     *     produces={"application/json"},
     *     operationId="POST_Create_matches",
     *     tags={"Match"},
     *     @SWG\Parameter(
     *          name="season",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="season ID",
     *      ),
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          schema={"$ref": "#/definitions/match_creation"},
     *          required=true
     *      ),
     *      @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY DONE"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     *     
     * )
     */
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


    //update match
    /**
     *   @SWG\Put(
     *     path="/api/Seasons/{season}/Event/update-match/{match}",
     *     description = "put update matche ",
     *     produces={"application/json"},
     *     operationId="Put_Update_matche",
     *     tags={"Match"},
     *     @SWG\Parameter(
     *          name="season",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="season ID",
     *      ),
     *     @SWG\Parameter(
     *          name="match",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="match ID",
     *      ),
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          schema={"$ref": "#/definitions/match_update"},
     *          required=true
     *      ),
     *      @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY DONE"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     *     
     * )
     */
    public function update(Request $request, Season $season, Match $match)
    {
        
    	if(!$season->active){
    		return response()->json(['message' => 'Season is inactive'], 404);
    	}

    	$match = $season->matches()->find($match->id);

        if(!$match){
            return response()->json([
                'message' => 'Match not found'
            ],404);
        }

    	$match->update($request->all());
    	
    	return response()->json([
            'data' => new MatchResource($match)
        ],201);
    }


    //delete match  swagger
    /**
     *  @SWG\Delete(
     *      path="/api/Seasons/{season}/Event/delete-match/{match}",
     *      tags={"Match"},
     *      operationId="deleteMatch",
     *      summary="Remove Match from database",
     *      
     *      @SWG\Parameter(
     *          name="season",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="season ID",
     *      ),   
     *      @SWG\Parameter(
     *          name="match",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="match ID",
     *      ),   
     *      @SWG\Response(
     *          response = 200,
     *          description="success",
     *      ),
     *      @SWG\Response(
     *          response = 401,
     *          description="error",
     *      )
     *  )
     *
     */
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
    	],200);
    }


    //get all matches in specific season swagger
    /**
     * @SWG\Get(
     *     path="/api/Seasons/{season}/Event/matches/stage/{stage_id}",
     *     description = "get all matches in specific season in specific stage",
     *     produces={"application/json"},
     *     operationId="GET_ALL_matches_stage",
     *     tags={"Match"},
     *     @SWG\Parameter(
     *          name="season",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="season ID",
     *      ),
     *     @SWG\Parameter(
     *          name="stage_id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="stage ID",
     *      ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY DONE"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     * )
     */
    public function findByStage(Season $season, $stage_id)
    {
    	$stage = $season->stages()->find($stage_id);
        if(!$stage){
            return response()->json([
                'message' => 'stage not found'
            ],404);
        }
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


    //get all matches in specific season in specific date swagger
    /**
     * @SWG\Get(
     *     path="/api/Seasons/{season}/Event/matches/{date}",
     *     description = "get all matches in specific season in specific date",
     *     produces={"application/json"},
     *     operationId="GET_ALL_matches_by_date",
     *     tags={"Match"},
     *     @SWG\Parameter(
     *          name="season",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="season ID",
     *      ),
     *     @SWG\Parameter(
     *          name="date",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="date",
     *      ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY DONE"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     * )
     */
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

    //get all matches of specific team  swagger
    /**
     * @SWG\Get(
     *     path="/api/Seasons/{season}/Event/{team}/matches",
     *     description = "get all matches for specific team in specific season",
     *     produces={"application/json"},
     *     operationId="GET_ALL_matches_for_team",
     *     tags={"Match"},
     *     @SWG\Parameter(
     *          name="season",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="season ID",
     *      ),
     *     @SWG\Parameter(
     *          name="team",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="RegisteredTeam id",
     *      ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY DONE"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     * )
     */
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


    //get all matches today swagger
    /**
     * @SWG\Get(
     *     path="/api/matches/today",
     *     description = "get all todays matches ",
     *     produces={"application/json"},
     *     operationId="GET_ALL_matches_today",
     *     tags={"Match"},
     *     @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY DONE"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     * )
     */
    public function todayMatches()
    {
    	$today = Carbon::now();
    	$today = $today->toDateString();


    	$matches = Match::where('date',$today)->get();

        if (!$matches->first()) {
            return response()->json([
                'Message' => 'there is no matches Today'
            ],404);
        }

        return response()->json([
                'data' => MatchResource::collection($matches)
            ],200);
    }


    //get all matches inProgressed swagger
    /**
     * @SWG\Get(
     *     path="/api/Seasons/{season}/Event/matches/InProgress",
     *     description = "get all matches inProgressed for specific season",
     *     produces={"application/json"},
     *     operationId="GET_ALL_matches_inProgressed",
     *     tags={"Match"},
     *     @SWG\Parameter(
     *          name="season",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="season ID",
     *      ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY DONE"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     * )
     */
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
