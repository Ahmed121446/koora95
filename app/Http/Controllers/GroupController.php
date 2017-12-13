<?php

namespace App\Http\Controllers;

use App\Repositories\Groups as GroupRepositorty;
use Illuminate\Http\Request;
use App\Group;
use App\GroupTeams;
use App\Season;
use App\Stage;
use App\Http\Requests\GroupRequest;


class GroupController extends Controller
{

    // Get All Groups
    public function findAllGroups(Stage $stage){
        $groups = $stage->groups;
        if (!$groups->first()) {
            return response()->json([
                'Message' => 'This Stage does not have groups'
            ],404);
        }
        return response()->json([
            'Message' => 'This Stage have groups',
            'Groups information' =>$groups->toArray()
        ],200);
    }


    // Retrieve Specific Group
    public function findOne(Stage $stage , Group $group){
        $Find_Group = $stage->groups()->find($group);
        return response()->json([
            'Message' => 'This Season have this group',
            'Groups information' => $Find_Group
        ],200);
    }


    // Create Stage Groups 
    public function createGroups(Season $season, Stage $stage, GroupRequest $request){
        $stage = $season->stages()->find($stage->id);

        $groups = $request->create_groups($stage);

        return response()->json([
                'Message' => 'Groups are created successfully',
                'data' => $groups
        ], 200);
    }


    // Add Teams To a Group
    public function AddTeams(Season $season, Group $group, GroupRepositorty $groupRepo)
    {
        $this->validate(request(), [
            'team_id' => 'required|exists:registered_teams,NULL,season_id,' . $season->id
        ]);

        $team = $groupRepo->addGroupTeams($group, Request('team_id'));

        return response()->json(['data' => $team], 201);

    }


    //Delete Group
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
