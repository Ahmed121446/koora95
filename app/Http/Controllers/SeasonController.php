<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\competition;

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

    public function Add_Season(Request $request){
    	$competition_id = $request->input('competition_id');
    	$find_comp = competition::find($competition_id);
    	
    	if (!$find_comp) {
    		return response()->json([
    			'Message' => 'this competition id is not found'
    		],404);
    	}

    	$find_comp_id = $find_comp->id;
    	$this->validate($request,[
    		'name' => 'required|min:2|max:25',
    		'competition_id' => 'required|numeric',
    		'is_active_season' => 'required|boolean'
    	]);

    	$season_name = $request->input('name');
    	$is_active_season = $request->input('is_active_season');

    	$Find_Duplicate = Season::where('name',$season_name)
    							->where('comp_id',$competition_id)
    							->count();
    	
    	if ($Find_Duplicate != 0) {
    		return response()->json([
    			'Message' => 'this season is already created'
    		],401);
    	}

    	$season = new Season();
    	$season->name = $season_name;
    	$season->comp_id = $competition_id;
    	$season->active = $is_active_season;

    	if (!$season->save()) {
    		return response()->json([
    			'Message' => 'this season can not be created'
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

		$Season->name = $request->input('name');
		$Season->comp_id = $request->input('competition_id');
    	$Season->active = $request->input('is_active_season');

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

   	public function destroy($id){
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


}
