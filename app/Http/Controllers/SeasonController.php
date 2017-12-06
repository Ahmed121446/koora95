<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\competition;

class SeasonController extends Controller
{
    public function Get_All_Seasons(){

    	$Seasons = Season::all();
    	if (!$Seasons->first()) {
    		return response()->json([
    			'Message' => 'No Seasons found , please create one .'
    		],404);
    	}
    	return response()->json([
    		'Message' => ' Seasons Found Congrats .',
    		'Seasons_data' => $Seasons->toArray()
    	],200);
    }

    public function Get_Season($id){
    	$Season = Season::find($id);
    	if (!$Season) {
    		return response()->json([
    			'Message' => 'No Season found , please create one .'
    		],404);
    	}
    	return response()->json([
    		'Message' => '  Found this Season Congrats .',
    		'Season_data' => $Season->toArray()
    	],200);
    }

    public function Get_Create_View_Seasons(){
    	$all_competitions = competition::all()->pluck('name');
    	return view('season.create',compact('all_competitions'));
    }

    public function Get_Update_View_Seasons($id){
    	$Season = Season::find($id);
    	if (!$Season) {
    		return response()->json([
    			'Message' => 'No Season found , please create one .'
    		],404);
    	}
    	$all_competitions = competition::all()->pluck('name');
    	return view('season.update',compact('Season','all_competitions'));
    }

    public function Create_Season(Request $request){
    	$this->validate($request,[
    		'name' 				=> 	'required|min:2|max:25',
    		'competition_id'	=>	'required|numeric',
    		'active_value'		=>	'required|boolean'
    	]);

    	$name 			= $request->get('name');
    	$competition_id = $request->get('competition_id');
    	$active_value 	= $request->get('active_value');

    	$Find_Dublicate = Season::where('name',$name)
    							->where('comp_id',$competition_id)
    							->count();
    	if ($Find_Dublicate != 0) {
    		return response()->json([
    			'Message' => 'this season is already created before '
    		],401);
    	}


    	$Season = new Season();
    	$Season->name = $name ;
    	$Season->comp_id = $competition_id ;
    	$Season->active = $active_value ;

    	if (!$Season->save()) {
    		return response()->json([
    			'Message' => 'this season can not be saved X-X '
    		],401);
    	}

    	return response()->json([
    			'Message' => 'this season is created successfully ',
    			'Season_information' => $Season->toArray()
    	],200);
    	
    }

    public function Update_Season(Request $request ,$id){
    	$Season = Season::find($id);
		if (!$Season) {
			return response()->json([
				'Message' => ' Season not found'
			],404);
		} 

		$this->validate($request,[
    		'name' 				=> 	'required|min:2|max:25',
    		'competition_id'	=>	'required|numeric',
    		'active_value'		=>	'required|boolean'
    	]);

		$name 				= $request->get('name');
    	$competition_id 	= $request->get('competition_id');
    	$active_value 		= $request->get('active_value');

    	$Find_Dublicate = Season::where('name',$name)
    							->where('comp_id',$competition_id)
    							->count();
    	if ($Find_Dublicate != 0) {
    		return response()->json([
    			'Message' => 'this season is already created before with the same name and competition, please check it .'
    		],401);
    	}

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
}
