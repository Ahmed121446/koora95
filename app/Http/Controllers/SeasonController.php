<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

use App\Season;
use App\Competition;
use App\Stage;
use App\Team;
use App\RegisteredTeam;
use App\Week;
use App\Round;
use App\Country;
use App\continent;
use App\Http\Requests\AddSeasonRequest;
use App\Http\Resources\SeasonResource;

class SeasonController extends Controller
{

    public function create(Competition $competition, Request $request)
    {
        $name = $request->get('name');

        $is_active = 0;

        if($request->get('is_active')){
            $is_active = $request->get('is_active');
        }


        $season = new Season();
        $season->name = $name;
        $season->active = $is_active;

        $season = $competition->seasons()->save($season);

        return response()->json([
                'Message' => 'this season is created successfully',
                'Season_Information' =>new SeasonResource( $season)
            ],201);
    }

    public function Specific_Season_View(Competition $competition, Season $season)
    {
        $RTeams = $season->registeredTeams;
        $location = $competition->location;

        if (!$location instanceof Country) {
            $Teams = [];
            $countries = Country::where('continent_id',$location->id)->get();
            foreach ($countries as $country) {
                $teams = Team::where('country_id',$country->id)->get();
                foreach ($teams as $team ) {
                    if(!$RTeams->find($team->id)){
                        array_push($Teams,$team);
                    }
                }
            } 
        }else{
            $Teams = Team::where('country_id',$location->id)->get();
        }

        return view('season.specific_Season',compact('season','Teams','RTeams'));
    }




    // Get Competition Seasons 
    /**
     * @SWG\Get(
     *     path="/api/Seasons/All-Seasons",
     *     description = "get all Seasons",
     *     produces={"application/json"},
     *     operationId="AllCompetitions",
     *     tags={"Season"},
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
    public function Get_All_Seasons(){
    	$seasons = Season::all();
    	if (!$seasons->first()) {
    		return response()->json([
    			'Message' => 'no Seasons found , please add season'
    		],404);
    	}
		return response()->json([
    			'Message' => 'found Seasons congrats',
    			'Seasons_data' => SeasonResource::collection( $seasons)
    	],200);
    }

    // Get Specific Season

    /**
     * @SWG\Get(
     *     path="/api/Seasons/{id}",
     *     description = "get Season by id",
     *     produces={"application/json"},
     *     operationId="findById",
     *     tags={"Season"},
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Season ID",
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
    public function Get_Season($Season){
    	$Season = Season::find($Season);
    	if (!$Season) {
    		return response()->json([
    			'Message' => 'no Seasons found , please add season'
    		],404);
    	}
    	return response()->json([
    			'Message' => 'found Season congrats',
    			'Seasons_data' =>new SeasonResource( $Season)
    		],200);
    }



    public function Get_Create_View_Season(){
    	$competitions_list = competition::all()->pluck('name');
    	$competitions_list_count = count($competitions_list);
    	if ($competitions_list_count > 0) {
    		return view('season.create',compact('competitions_list'));
    	}else{
    		$competitions_list = null;
    		return view('season.create',compact('competitions_list'));
    	}
    }

    // Create New Season


    /**
     *   @SWG\Post(
     *     path="/api/Seasons/Create",
     *     description = "Create new Season",
     *     produces={"application/json"},
     *     operationId="createSeason",
     *     tags={"Season"},
     *
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          schema={"$ref":"#/definitions/season"},
     *      ),
     *      @SWG\Response(
     *         response = 201,
     *         description = "SUCCESSFULLY CREATED"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     *     
     * )
     */
    public function Add_Season(AddSeasonRequest $request){
    	$competition_id = $request->input('competition_id');
    	$competition = competition::find($competition_id);
    	
    	if (!$competition) {
    		return response()->json([
    			'Message' => 'this competition id is not found'
    		],404);
    	}



    	$season_name = $request->input('name');
    	$is_active_season = $request->input('is_active_season');


    	$season = new Season();
    	$season->name = $season_name;
    	$season->active = $is_active_season;

        $season = $competition->seasons()->save($season);


    	if (!$season) {
    		return response()->json([
    			'Message' => 'this season can not be saved X-X '
    		],401);
    	}

    	return response()->json([
    			'Message' => 'this season is created successfully',
    			'Season_Information' =>new SeasonResource( $season)
    		],201);
    }


    // Update Season
    /**
     *   @SWG\Put(
     *     path="/api/Seasons/Update/{id}",
     *     description = "update Season",
     *     produces={"application/json"},
     *     operationId="updateSeason",
     *     tags={"Season"},
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Season ID",
     *      ),
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          schema={"$ref":"#/definitions/season"},
     *      ),
     *      @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY updated"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     *     
     * )
     */
    public function Update_Season(Request $request , $id){
		$Season = Season::find($id);
		if (!$Season) {
			return response()->json([
				'Message' => ' Season not found'
			],404);
		}


		$this->validate($request,[
    		'name' 				=> 	[
                'required',
                'min:2',
                'max:25',
                Rule::unique('seasons')->where(function ($query) {
                    return $query->where('comp_id', Request('competition_id'));
                })->ignore($Season->id)
            ],
            'competition_id' => 'required|numeric',
    		'is_active_season'		=>	'required|boolean'
    	]);

		$name 				= $request->get('name');
    	$competition_id 	= $request->get('competition_id');
    	$active_value 		= $request->get('is_active_season');


    	$Season->name 		= $name;
    	$Season->comp_id 	= $competition_id;
    	$Season->active 	= $active_value;

		if (!$Season->update()) {
			return response()->json([
				'Message' => 'This Season Can Not be updated',
				'Season_Information' =>new SeasonResource( $Season)
			],409);
		}
		return response()->json([
			'Message' => 'This Season updated successfully congrats',
			'Season_Information' =>new SeasonResource( $Season)
		],200); 
	}


    // Delete Season
    /**
     * @SWG\Delete(
     *     path="/api/Seasons/Delete/{id}",
     *     description = "Delete Season",
     *     produces={"application/json"},
     *     operationId="delete",
     *     tags={"Season"},
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Season ID",
     *      ),
     *     @SWG\Response(
     *         response = 204,
     *         description = "SUCCESSFULLY Deleted"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     * )
     */
    public function Destroy_Season($id){
    	$Season = Season::find($id);

		if (!$Season) {
			return response()->json([
				'Message' => ' Season not found'
			],404);
		}

		if (!$Season->delete()) {
			return response()->json([
				'Message' => ' Season Cannot be deleted X-X'
			],401);
		}

		return response()->json([
			'Message' => ' Season is deleted successfully '
		],200);
	}



    // Add Season Weeks/Rounds
    public function Season_Stages(Season $season)
    {
        $competition = $season->competition;

        if(!$competition->is_cup()){

            $number_of_teams = count($season->registeredTeams);
            $weeks_number = ($number_of_teams -1) * 2;

            $weeks = Week::all()->take($weeks_number);
            foreach ($weeks as $week) {
                $stage = new Stage();
                $stage->season_id = $season->id;
                $week->stages()->save($stage);
            }

        }else{
            $rounds = Round::all();
            
            foreach ($rounds as $round) {
                $stage = new Stage();
                $stage->season_id = $season->id;
                $round->stages()->save($stage);
            }
        }
    }



}
