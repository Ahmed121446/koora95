<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;

use App\Http\Requests\TeamRequests;
use App\Http\Resources\TeamResource;
use Illuminate\Http\Request;
use App\Team;
use App\Country;


class TeamsController extends Controller
{
    public function All_Teams(Request $request)
    {
        if ($request->has('name') || $request->has('type')) {

            $name = $request->get('name');
            $type = $request->get('type');

            $resualt = Team::where('name','LIKE',"{$name}%");
            if($type > 0){
                $resualt->where('type_id',$type);
            }
            $all_teams = $resualt->paginate(25)->appends('name',"{$name}%");

        }else{
            $all_teams = Team::paginate(25);
        }
        
       return view('team.all_teams',compact('all_teams'));
    }
    
    public function Create_View()
    {
        $all_Countries = Country::all();
        return view('team.create',compact('all_Countries'));
    }

    public function create(TeamRequests $request){

        Team::create([
            'name' => $request->get('name'),
            'type_id' => 1,
            'stadium' => $request->get('stadium'),
            'country_id' => $request->get('country_id')
        ]);

        return redirect('/');
    }

    public function remove_team($id)
    {
        $find_team = Team::find($id);
        $find_team->delete();
        return redirect()->back();
    }

    //get all Teams
    /**
     * @SWG\Get(
     *     path="/api/Teams/All-Teams",
     *     description = "get all Teams",
     *     produces={"application/json"},
     *     operationId="GET_ALL_Teams",
     *     tags={"Team"},
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
    public function Get_All_Teams(){
        $Teams = Team::all();
        if (!$Teams->first()) {
            return response()->json([
                'Message' => 'No Teams found , please create one .'
            ],404);
        }
        return response()->json([
            'Message' => ' Teams Found Congrats .',
            
            'Teams_data' =>TeamResource::collection ($Teams)
        ],200);
    }

    //Get team swagger
    /**
     * @SWG\Get(
     *     path="/api/Teams/{id}",
     *     description = "get Team with it's id",
     *     produces={"application/json"},
     *     operationId="GET_Team",
     *     tags={"Team"},
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="Team ID",
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
    public function Get_Team($id){
        $Team = Team::find($id);
        if (!$Team) {
            return response()->json([
                'Message' => 'Team not Found'
            ],404);
        }
        return response()->json([
            'Message' => '  Found this Team Congrats .',
            'Team_data' =>new TeamResource( $Team)
        ],200);
    }


    //create Teams
    /**
     *   @SWG\Post(
     *     path="/api/Teams/Create",
     *     description = "post Create Team form ",
     *     produces={"application/json"},
     *     operationId="POST_Create_Team",
     *     tags={"Team"},
     *
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          schema={"$ref": "#/definitions/Team_creation"},
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
    public function Create_Team(Request $request, TeamRequests $teamRequest){

        $team = $teamRequest->store();

        return response()->json([
            'Message' => 'Team is created successfully',
            'Team_Data' => new TeamResource($team)
        ],200);
    }


    //update Teams
    /**
     *   @SWG\Put(
     *     path="/api/Teams/Update/{id}",
     *     description = "post Create Team form ",
     *     produces={"application/json"},
     *     operationId="POST_Create_Team",
     *     tags={"Team"},
     *     
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="team id",
     *      ),
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          schema={"$ref": "#/definitions/Team_creation"},
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
    public function Update_Team(Request $request ,$id){
        $Team = Team::find($id);

        if (!$Team) {
            return response()->json([
                'Message' => ' Team not found'
            ],404);
        } 
        $this->validate($request,[
            'name'          =>  'required|min:2|max:25',
            'type_id'       =>  'required|numeric',
            'logo'          =>  'required',
            'stadium'       =>  'required|min:2|max:25',
            'country_id'    =>  [
                'required',
                'numeric',
                Rule::unique('teams')->where(function ($query) {
                    return $query->where('name', Request('name'));
                })->ignore($Team->id)
            ]
        ]);

        $name               = $request->get('name');
        $type_id            = $request->get('type_id');
        $logo               = $request->get('logo');
        $stadium            = $request->get('stadium');
        $country_id         = $request->get('country_id');


        $Team->name         = $name ;
        $Team->type_id      = $type_id ;
        $Team->logo         = $logo ;
        $Team->stadium      = $stadium ;
        $Team->country_id   = $country_id ;

        if (!$Team->update()) {
            return response()->json([
                'Message' => 'This Team Can Not be updated',
                'Team_Information' =>new TeamResource( $Team)
            ],409);
        }
        return response()->json([
            'Message' => 'This Team updated successfully congrats',
            'Team_Information' => new TeamResource( $Team)
        ],200); 
    }


    //delete team swagger
    /**
     *  @SWG\Delete(
     *      path="/api/Teams/Delete/{id}",
     *      tags={"Team"},
     *      operationId="deleteTeam",
     *      summary="Remove Team from database",
     *      
     *      @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="Team ID",
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
    public function Destroy_Team($id){
        $Team = Team::find($id);
        if (!$Team) {
            return response()->json([
                'Message' => ' Team not found'
            ],404);
        }

        if (!$Team->delete()) {
            return response()->json([
                'Message' => ' Team Cannot be deleted X-X'
            ],401);
        }

        return response()->json([
            'Message' => ' Team is deleted successfully '
        ],200);
    }

}
