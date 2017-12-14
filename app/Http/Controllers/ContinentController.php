<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\continent;
use App\Http\Resources\ContinentResource ;
class ContinentController extends Controller
{
    public function Get_All_Continents(){
    	//get all continent form the DB and featch them all
    	$Continents = continent::all();
    	//if there is no continent so it will return message and 404 error
    	if (!$Continents->first()) {
    		return response()->json([
    			'Message' => 'no Continent found'
    		],404);
    	}
    	//if found Continents so it will return message and all Continents with the data
    	//also send 200 code status
    	return response()->json([
    			'Message' => 'All Continent found',
    			'Continent' => ContinentResource::collection($Continents) 
    	],200);
    }


    public function Get_Continent($id){
    	//featch Continent by its id 
    	//which is taken from the url Continent/{id}
    	$Continent = continent::find($id);
    	//if this Continent is not exist return message and status code 404
    	if (!$Continent) {
    		return response()->json([
    			'Message' => 'no Continent found '
    		],404);
    	}
    	//if found this Continent so return message and the Continent data and also 200 status code
    	return response()->json([
    			'Message' => 'Continent found',
    			'Continent' =>new  ContinentResource($Continent)
    	],200);    	
    }


}
