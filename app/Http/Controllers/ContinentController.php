<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\continent;
use App\Http\Resources\ContinentResource ;
class ContinentController extends Controller
{   
    //Get All continents swagger
    /**
     * @SWG\Get(
     *     path="/api/Continent/All-Continent",
     *     description = "get all Continents",
     *     produces={"application/json"},
     *     operationId="GET_ALL_Continents",
     *     tags={"Continent"},
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

    //Get All continents swagger
    /**
     * @SWG\Get(
     *     path="/api/Continent/{id}",
     *     description = "get Continent with it's id",
     *     produces={"application/json"},
     *     operationId="GET_Continent",
     *     tags={"Continent"},
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="Continent ID",
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
