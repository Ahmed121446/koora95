<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Season;
use App\Http\Requests\GroupRequest;


class GroupController extends Controller
{


    public function index(){
    }

    public function Get_All_Groups_In_Season(Season $season){
        $groups = $season->groups;
        if (!$groups->first()) {
            return response()->json([
                'Message' => 'This Season does not have groups'
            ],404);
        }
        return response()->json([
            'Message' => 'This Season have groups',
            'Groups information' =>$groups->toArray()
        ],200);
    }

    public function Get_Group_In_Season(Season $season , Group $group){
        $Find_Group = $season->groups()->find($group);
        return response()->json([
            'Message' => 'This Season have this group',
            'Groups information' => $Find_Group
        ],200);
    }

    public function Add_Group(Season $season,GroupRequest $request){

        $group_name = $request->get('group_name');
        $new_group = new Group();
        $new_group->name =$group_name;


        if ($group = !$season->groups()->save($new_group) ) {
            return response()->json([
                'Message' => 'this group can not be created'  
            ], 401);
        }
        return response()->json([
                'Message' => 'this group is created successfully',
                'Group Data' => $new_group
        ], 200);
    }

    public function delete(Season $season, $group){
        $group_in_season = $season->groups()->where('name',$group)->first();
        if (!$group_in_season) {
            return response()->json([
                'Message' => 'this group is not exist'
            ], 404);
        }
        if (!$group_in_season->delete()) {
            return response()->json([
                'Message' => 'this group can not be deleted X-X'
            ], 402);
        }
        return response()->json([
            'Message' => 'group deleted successfully'
        ], 204);
    }





  
}
