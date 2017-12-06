<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;

class TeamsController extends Controller
{

    public function Get_All_Teams(){
        $teams = Team::all();
        if (!$teams->first()) {
           return response()->json([
            'Message' => 'no teams found'
            ], 404);
        }
        return response()->json([
            'Message' => 'All Teams Found',
            'Teams' => $teams->toArray()
        ], 200);
    }

    public function Get_Team( $id){
        $team = Team::find($id);
        if(!$team){
            return response()->json([
                'Message' => 'no team found'
            ],404);
        }
        return response()->json([
            'Message' => ' team found',
            'data' => $team->toArray()
        ], 200);
    }

    public function Create_Team(Request $request){
        $this->validate($request,[
            'name'          =>  'required|max:25|min:2',
            'type_id'       =>  'required|numeric',
            'stadium'       =>  'required|max:25|min:2',
            'country_id'    =>  'required|numeric',
        ]);
        $name           =   $request->input('name');
        $type_id        =   $request->input('type_id');
        $logo           =   $request->input('logo');
        $stadium        =   $request->input('stadium');
        $country_id     =   $request->input('country_id');

        $Find_Duplicate = Team::where('name',$name)
                                ->where('country_id',$country_id)
                                ->count();

        if ($Find_Duplicate != 0) {
            return response()->json([
                'Message' => 'this team is already created'
            ],401);
        }

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
        $Team = Team::find($id);
        if (!$Team) {
            return response()->json([
                'Message' => ' Team not found'
            ],404);
        } 

        $name           =   $request->input('name');
        $type_id        =   $request->input('type_id');
        $logo           =   $request->input('logo');
        $stadium        =   $request->input('stadium');
        $country_id     =   $request->input('country_id');

        $Team->name         =  $name;
        $Team->type_id      =  $type_id ;
        $Team->logo         =  $logo ;
        $Team->stadium      =  $stadium;
        $Team->country_id   =  $country_id ;
       
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

    
    public function destroy($id){
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
