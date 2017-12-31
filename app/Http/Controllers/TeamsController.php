<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;

use App\Http\Requests\TeamRequests;
use App\Http\Resources\TeamResource;
use Illuminate\Http\Request;
use App\Team;
use App\Country;
use App\TeamType;



class TeamsController extends Controller
{
    public function __construct(){
            $this->middleware('auth')->except(['All_Teams']);
    }
    public function All_Teams(Request $request)
    {
        $types = TeamType::all();
        $Countries = Country::all();
        if ($request->has('name') || $request->has('type')) {

            $name = $request->get('name');
            $type = $request->get('type');

            $resualt = Team::where('name','LIKE',"{$name}%");
            if($type > 0){
                $resualt->where('type_id',$type);
            }
            $all_teams = $resualt->paginate(25)->appends('name',"{$name}");

        }else{
            $all_teams = Team::paginate(25);
        }
        
       return view('team.all_teams',compact('all_teams','types','Countries'));
    }
    
    public function Create_View()
    {
        $all_Countries = Country::all();
        return view('team.create',compact('all_Countries'));
    }

    public function create(TeamRequests $request){

        $team = $request->store();

        return redirect()->intended();
    }

    public function remove_team($id)
    {
        $find_team = Team::find($id);
        $find_team->delete();
        return redirect()->back();
    }


    public function update($team_id,Request $request)
    {
        $find_team = Team::find($team_id);
        if(!$find_team){
            return  'team not found';
        }
        $find_team->name          = $request->get('team_name');
        $find_team->type_id       = $request->get('type_id');
        $find_team->stadium       = $request->get('stadium');
        $find_team->country_id    = $request->get('country_id');

        if (!$find_team->update()) {
            return "team can not be updated";
        }
        return "team updated successfully";
    }

}
