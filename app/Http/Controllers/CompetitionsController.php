<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompetitionRequest;

use Illuminate\Http\Request;
use App\Competition;
use App\continent;
use App\Country;
use App\Http\Resources\CompetitionResource;

class CompetitionsController extends Controller
{
    //create view for competition
    public function Create_View()
    {
       $all_countries = Country::all();
       $all_continents = continent::all();

       return view('Competition.create',compact(['all_countries','all_continents']));
    }






    //Get All competitions swagger
    /**
     * @SWG\Get(
     *     path="/api/competitions",
     *     description = "get all competitions",
     *     produces={"application/json"},
     *     operationId="AllCompetitions",
     *     tags={"Competition"},
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
    public function findAll()
    {
        $competitions = Competition::all();

        if(!$competitions->first()){
            return response()->json(['message' => 'There is No Competitions' ], 404);
        }

    	return response()->json([
            'data' => CompetitionResource::collection( $competitions)
        ], 200);
    }



    //Find Competition By its ID

    /**
     * @SWG\Get(
     *     path="/api/competitions/{id}",
     *     description = "get competition by id",
     *     produces={"application/json"},
     *     operationId="findById",
     *     tags={"Competition"},
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Competition ID",
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
    public function findById(Competition $competition){
    	return response()->json([
            'data' =>new CompetitionResource( $competition)
        ], 200);
    
    }


    // Create New Competition

    /**
     *   @SWG\Post(
     *     path="/api/competitions",
     *     description = "Create new Competition",
     *     produces={"application/json"},
     *     operationId="createCompetition",
     *     tags={"Competition"},
     *
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          schema={"$ref":"#/definitions/competition"},
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
    public function create(CompetitionRequest $request)
    {   
        $competition = $request->store();

    	return response()->json([
            'data' =>new CompetitionResource( $competition)
        ], 201);

    }


    // Update a Competition Data
    /**
     *   @SWG\Put(
     *     path="/api/competitions/update/{id}",
     *     description = "update Competition",
     *     produces={"application/json"},
     *     operationId="updateCompetition",
     *     tags={"Competition"},
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Competition ID",
     *      ),
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          schema={"$ref":"#/definitions/competition"},
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
    public function update(CompetitionRequest $request, Competition $competition)
    {
    	$competition = $request->update($competition);

    	return response()->json([
            'data' =>new CompetitionResource($competition)
        ], 200);
    }

    // Delete a Competition


    /**
     * @SWG\Delete(
     *     path="/api/competitions/delete/{id}",
     *     description = "Delete competition",
     *     produces={"application/json"},
     *     operationId="delete",
     *     tags={"Competition"},
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Competition ID",
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
    public function delete(Competition $competition)
    {
    	if(! $competition->delete()){
            return response()->json(['message' => 'an error occured'], 500);
        }

    	return response()->json(['message' => "Competition deleted successfully"], 204);
    }

}
