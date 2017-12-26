<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchRequest;

use App\Repositories\Matches as MatchesRepo;
use App\Http\Resources\MatchResource  ;
use Image;
use Storage;


use Illuminate\Http\Request;
use App\Match;
use App\Season;
use App\Team;
use Carbon\Carbon;
use App\RegisteredTeam;
use App\Stage;
use App\competition;


class MatchesController extends Controller
{
    public function test(){
        $season_id = $_GET['ch'];
        $Rteams_names =[];
        if ($season_id == 0) {
            $teams = Team::all();
            foreach ($teams as $team ) {
                 $Rteams_names[$team->id] = $team->name;
            }
            return  $Rteams_names;
        }else{
            $season = Season::find($season_id);
            $teams = $season->registeredTeams;
            foreach ($teams as $team ) {
                $Rteams_names[$team->id] = $team->team->name;
            }
            return $Rteams_names;
        }

    }
    public function ALL_matches_View(Request $request){

        $seasons = Season::where('active', 1)->get();

        $all_matches = Match::filter($request->all())->paginate(10);

        if($request->has('season') && $request->get('season') != 0){
            $stages = Season::find($request->get('season'))->stages;
        }
        if($request->has('stage') && $request->get('stage') != 0){
            $rounds = Stage::find($request->get('stage'))->groupRounds;
        }

        return view('match.all_Matches',compact(['all_matches', 'seasons', 'stages', 'rounds']));
    
    }
    public function Create(Request $request){

        // $match = new Match();
        // $match->season_id = $request->get('season_id');
        // $match->date = $request->get('date');
        // $match->time = $request->get('time');
        // $match->stage_id = $request->get('stage_id');
        // $match->stadium = $request->get('stadium');
        // $match->status = 
        // $match->register_team_1_id = $request->get('Rteams1');
        // $match->register_team_2_id = $request->get('Rteams2');
        // $match->save();
        $match =  new Match([
            'date'  => $request->get('date'),
            'time' => $request->get('time'),
            'stage_id' => $request->get('stage_id'),
            'season_id' => $request->get('season_id'),
            'register_team_1_id' => $request->get('Rteams1'),
            'register_team_2_id' => $request->get('Rteams2'),
            'stadium' => $request->get('stadium'),
            'status' => "Not Played Yet",
            'team_1_goals' => 0,
            'team_2_goals' => 0,
            'winner_id' => 0,
            'red_cards' => 0,
            'yellow_cards' => 0
        ]);
        $match->save();
        return redirect()->route('home');
    }

    public function Get_Today_Matches_View(){
       $today = Carbon::now();
        $today = $today->toDateString();
        $matches = Match::where('date',$today)->get();

        $competitions = $matches->groupBy(function ($item, $key) {
            if ($item->season == null) {
                return "friendly matches";
            }else{
                return $item->season->competition->name;
            }
        });
        return view('welcome',compact('competitions'));
    }

    public function Add_Match_View()
    {
        $season = Season::where('active',1)->get();
        $competitions = $season->groupBy(function ($item, $key) {
            return $item->competition->name;
        });

        return view('match.create',compact('competitions'));
    }

    public function remove_match($id){
        $find_match = Match::find($id);
        $find_match->delete();
        return redirect()->back();
    }

    public function update_match($match_id,Request $request){
       $find_match = Match::find($match_id);
        if(!$find_match){
            return  'Match not found';
        }
        $this->validate($request,[
            'stadium' => 'required|min:2|max:25'
        ]);
        $find_match->date            = $request->get('date');
        $find_match->time            = $request->get('time');
        $find_match->stadium         = $request->get('stadium');
        $find_match->team_1_goals    = $request->get('FTG');
        $find_match->team_2_goals    = $request->get('STG');
        $find_match->red_cards       = $request->get('red');
        $find_match->yellow_cards    = $request->get('yellow');
        if (!$find_match->update()) {
            return "match can not be updated";
        }
        return "match updated successfully";
    } 






    public function Get_S_Match(Match $match){
        $team1_image = $match->Team1->logo;
        $image1 = Image::make(Storage::get('public/images/teams-logos/'.$team1_image))->resize(110,110);
        $team2_image = $match->Team2->logo;
        $image2 = Image::make(Storage::get('public/images/teams-logos/'.$team2_image))->resize(110,110);
        
        $img = Image::canvas(1200, 350, '#1f1f1f');
        $img->insert($image1, 'top-left',200,160);
        $img->insert($image2, 'top-right',200,160);

        //match Stadium
        $img->text("Stadium : ".$match->stadium, 50, 40, function($font) {
            $font->file('font/Raleway-Light.ttf');
            $font->color(array(255, 255, 255, 1));
            $font->size(18);
        });
        //match red_cards
        $img->text("Red Cards : ".$match->red_cards, 220, 40, function($font) {
            $font->file('font/Raleway-Light.ttf');
            $font->color(array(200, 30, 45, 1));
            $font->size(15);
        });
        //match yellow_cards
        $img->text("Yellow Cards : ".$match->yellow_cards, 350, 40, function($font) {
            $font->file('font/Raleway-Light.ttf');
            $font->color(array(255, 219, 87, 0.8));
            $font->size(15);
        });

        //white line
        $img->line(20, 60, 1180, 60, function ($draw) {
            $draw->color('#fff');
        });

        //first team name
        $img->text($match->Team1->name, 80, 220, function($font) {
            $font->file('font/yanonekaffeesatz-regular-webfont.ttf');
            $font->color(array(255, 255, 255, 1));
            $font->size(25);
        });
        //second team name
        $img->text($match->Team2->name, 1020, 220, function($font) {
            $font->file('font/yanonekaffeesatz-regular-webfont.ttf');
            $font->color(array(255, 255, 255, 1));
            $font->size(25);
        });
        //second team goals
        $img->text($match->team_2_goals, 850, 220, function($font) {
            $font->file('font/yanonekaffeesatz-regular-webfont.ttf');
            $font->color(array(255, 255, 255, 1));
            $font->size(30);
        });
        //first team goals
        $img->text($match->team_1_goals, 330, 220, function($font) {
            $font->file('font/yanonekaffeesatz-regular-webfont.ttf');
            $font->color(array(255, 255, 255, 1));
            $font->size(30);
        });

         //competition name
        $img->text($match->season->competition->name, 490, 150, function($font) {
            $font->file('font/PoiretOne-Regular.ttf');
            $font->color(array(255, 255, 255, 1));
            $font->size(40);
        });
        //season name
        $img->text($match->season->name, 560, 200, function($font) {
            $font->file('font/PoiretOne-Regular.ttf');
            $font->color(array(255, 255, 255, 1));
            $font->size(30);
        });

        //match time
        $img->text($match->time, 550, 260, function($font) {
            $font->file('font/PoiretOne-Regular.ttf');
            $font->color(array(169, 68, 66, 1));
            $font->size(20);
        });

        //match status
        $img->text($match->status, 595, 300, function($font) {
            $font->file('font/Cairo-Regular.ttf');
            $font->color(array(169, 68, 66, 1));
            $font->align('center');
            $font->size(20);
        });

        


        return $img->response('png');
    }



    /**

    //get all matches in specific season swagger
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
        ],200);
    }


    /**
     * @SWG\Get(
     *     path="/api/Seasons/{season}/Event/matches/stage/{stage_id}/round/{group_round_id}",
     *     description = "get all matches in group stage with a given round",
     *     produces={"application/json"},
     *     operationId="GET_Group_matches_stage",
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
     *     @SWG\Parameter(
     *          name="group_round_id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="round ID",
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
    public function findInGroupStage(Season $season, $stage_id, $group_round_id)
    {
        $stage = $season->stages()->find($stage_id);
        if(!$stage){
            return response()->json([
                'message' => 'stage not found'
            ],404);
        }
        $matches = $stage->matches()->where('group_round_id', $group_round_id)->get();
        return response()->json([
            'data' => MatchResource::collection($matches)
        ],200);
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
    /**
     * @SWG\Get(
     *     path="/api/matches/{date}",
     *     description = "get all matches in specific date",
     *     produces={"application/json"},
     *     operationId="GET_ALL_matches_by_date",
     *     tags={"Match"},
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







    //confirm match Result
    /**
     *   @SWG\Post(
     *     path="/api/Seasons/{season}/Event/matches/{match}/confirm",
     *     description = "post confirm matche Result ",
     *     produces={"application/json"},
     *     operationId="POST_confirm_matche",
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
     *          schema={"$ref": "#/definitions/match_confirm"},
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
