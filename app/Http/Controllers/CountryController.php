<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\Http\Requests\CreateCountryRequest;
use App\Http\Resources\CountryResource;

class CountryController extends Controller
{
	public function Get_All_Countries(){
		//get all Countries form the DB and featch them all
		$Countries = Country::all();
		//if there is no Countries so it will return message and 404 error
		if (!$Countries->first()) {
			return response()->json([
				'Message' => 'no countries found'
			],404);
		}
		//if found Countries so it will return message and all Countries with the data
    	//also send 200 code status
		return response()->json([
			'Message' => 'All countries found',
			'Countries' => CountryResource::collection($Countries)
		],200);
	}

	public function Get_Country($id){
		//featch Country by its id 
    	//which is taken from the url Country/{id}
		$Country = Country::find($id);
		//if this Country is not exist return message and status code 404
		if (!$Country) {
			return response()->json([
				'Message' => ' Country not found'
			],404);
		}
    	//if found this Country so return message and the Continent data 
    	//and also 200 status code
		return response()->json([
			'Message' => 'this Country is found',
			'Country' =>new CountryResource( $Country )
		],200);
	}

	public function Get_Country_Create_View(){
		//get create view
		return view('country.create');
	}

	public function Create_Country(CreateCountryRequest $request){
		$name = $request->input('name');
		$Continent_id = $request->input('Continent_id');

		$Country = new Country();
		$Country->name = $name;
		$Country->continent_id = $Continent_id;

		if (!$Country->save()) {
			return response()->json([
				'Message' => 'Country cannot be created'
			],400);
		}

		return response()->json([
			'Message' => 'Country is created successfully',
			'Country_Data' =>new CountryResource($Country) 
		],200);
	}


	public function Get_Country_Update_View($id){
		$Country_data = Country::find($id);
		if (!$Country_data) {
			return response()->json([
				'Message' => 'no country found by this id.'
			],404);
		} 

		//return update page 
		return view('country.update',compact('Country_data'));
	}
	
	
	public function Update_Country(CreateCountryRequest $request , $id){
		$Country = Country::find($id);
		if (!$Country) {
			return response()->json([
				'Message' => ' Country not found'
			],404);
		} 

		$Country->name = $request->get('name');
		$Country->continent_id = $request->get('Continent_id');

		if (!$Country->update()) {
			return response()->json([
				'Message' => 'This country Can Not be updated',
				'Country_Information' =>new CountryResource( $Country)
			],409);
		}
		return response()->json([
			'Message' => 'This country updated successfully congrats',
			'Country_Information' =>new CountryResource( $Country) 
		],200); 
	}
	

	public function destroy($id){
		$Country = Country::find($id);

		if (!$Country) {
			return response()->json([
				'Message' => ' Country not found'
			],404);
		}

		if (!$Country->delete()) {
			return response()->json([
				'Message' => ' Country Cannot be deleted X-X'
			],401);
		}

		return response()->json([
			'Message' => ' Country is deleted successfully '
		],200);
	}



}
