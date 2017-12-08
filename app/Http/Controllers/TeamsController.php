<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequests;

use Illuminate\Http\Request;
use App\Team;


class TeamsController extends Controller
{

    public function __construct(TeamRequests $teamRequest)
    {

    }
    

    public function Get_All_Teams(){
        $Teams = Team::all();
        if (!$Teams->first()) {
            return response()->json([
                'Message' => 'No Teams found , please create one .'
            ],404);
        }
        return response()->json([
            'Message' => ' Teams Found Congrats .',
            'Teams_data' => $Teams->toArray()
        ],200);
    }


    public function Get_Team($id){
        $Team = Team::find($id);
        if (!$Team) {
            return response()->json([
                'Message' => 'No Team found , please create one .'
            ],404);
        }
        return response()->json([
            'Message' => '  Found this Team Congrats .',
            'Team_data' => $Team->toArray()
        ],200);
    }


    public function Get_Create_View_Teams(){
      
    }
    public function Get_Update_View_Teams($id){
    }


    public function Create_Team(Request $request){

        $name           =   $request->input('name');
        $type_id        =   $request->input('type_id');
        $logo           =   $request->input('logo');
        $stadium        =   $request->input('stadium');
        $country_id     =   $request->input('country_id');


        $Team = new Team();
        $Team->name         = $name;
        $Team->type_id      = $type_id;
        $Team->logo         = $logo;
        $Team->stadium      = $stadium;
        $Team->country_id   = $country_id;

        if (!$Team->save()) {
            return response()->json([
                'Message' => 'Team cannot be created'
            ],400);
        }

        return response()->json([
            'Message' => 'Team is created successfully',
            'Team_Data' => $Team->toArray() 
        ],200);
    }




    public function Update_Teams(Request $request , $id){
        $Team->name         = $name ;
        $Team->type_id      = $type_id ;
        $Team->logo         = $logo ;
        $Team->stadium      = $stadium ;
        $Team->country_id   = $country_id ;

        if (!$Team->save()) {
            return response()->json([
                'Message' => 'this Team can not be saved X-X '
            ],401);
        }

        return response()->json([
                'Message' => 'this Team is created successfully ',
                'Team_information' => $Team->toArray()
        ],200);   
    }

    public function Update_Team(Request $request ,$id){
        $Team = Team::find($id);
        if (!$Team) {
            return response()->json([
                'Message' => ' Team not found'
            ],404);
        } 

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
                'Team_Information' => $Team->toArray()
            ],409);
        }
        return response()->json([
            'Message' => 'This Team updated successfully congrats',
            'Team_Information' => $Team->toArray()
        ],200); 
    }



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
