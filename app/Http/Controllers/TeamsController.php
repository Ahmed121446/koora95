<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;


class TeamsController extends Controller
{
    
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
        $this->validate($request,[
            'name'          =>  'required|min:2|max:25',
            'type_id'       =>  'required|numeric',
            'logo'          =>  'required',
            'stadium'       =>  'required|min:2|max:25',
            'country_id'    =>  'required|numeric'
        ]);
        $name           =   $request->input('name');
        $type_id        =   $request->input('type_id');
        $logo           =   $request->input('logo');
        $stadium        =   $request->input('stadium');
        $country_id     =   $request->input('country_id');

        $Find_Dublicate = Team::where('name',$name)
                                ->where('country_id',$country_id)
                                ->count();

        if ($Find_Dublicate != 0) {
            return response()->json([
                'Message' => 'this Team is already created with in the same country '
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
            'country_id'    =>  'required|numeric'
        ]);

        $name               = $request->get('name');
        $type_id            = $request->get('type_id');
        $logo               = $request->get('logo');
        $stadium            = $request->get('stadium');
        $country_id         = $request->get('country_id');

        $Find_Dublicate = Team::where('name',$name)
                                ->where('country_id',$country_id)
                                ->count();

        if ($Find_Dublicate != 0) {
            return response()->json([
                'Message' => 'this Team is already created with in the same country '
            ],401);
        }

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
