<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

use App\Season;
use App\competition;
use App\Stage;
use App\RegisteredTeam;
use App\Week;
use App\Round;

use App\Http\Requests\AddSeasonRequest;


class SeasonController extends Controller
{

    public function Get_All_Seasons(){
    	$seasons = Season::all();
    	if (!$seasons->first()) {
    		return response()->json([
    			'Message' => 'no Seasons found , please add season'
    		],404);
    	}
		return response()->json([
    			'Message' => 'found Seasons congrats',
    			'Seasons_data' => $seasons->toArray()
    	],200);
    }

    public function Get_Season($Season){
    	$Season = Season::find($Season);
    	if (!$Season) {
    		return response()->json([
    			'Message' => 'no Seasons found , please add season'
    		],404);
    	}
    	return response()->json([
    			'Message' => 'found Season congrats',
    			'Seasons_data' => $Season
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
    			'Season_Information' => $season->toArray()
    		],401);
    }

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
    		'active_value'		=>	'required|boolean'
    	]);

		$name 				= $request->get('name');
    	$competition_id 	= $request->get('competition_id');
    	$active_value 		= $request->get('active_value');


    	$Season->name 		= $name;
    	$Season->comp_id 	= $competition_id;
    	$Season->active 	= $active_value;

		if (!$Season->update()) {
			return response()->json([
				'Message' => 'This Season Can Not be updated',
				'Season_Information' => $Season->toArray()
			],409);
		}
		return response()->json([
			'Message' => 'This Season updated successfully congrats',
			'Season_Information' => $Season->toArray()
		],200); 
	}



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



    public function Season_Stages(Season $season){
        $number_of_teams = count($season->registeredTeams);
        $number_of_teams *=  2;

        

        $weeks = Week::all()->take($number_of_teams);
        foreach ($weeks as $week) {
            $stage = new Stage();
            $stage->season_id = $season->id;
            $week->stages()->save($stage);
        }
          
           

    }



}
