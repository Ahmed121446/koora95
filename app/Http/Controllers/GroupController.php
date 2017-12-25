<?php

namespace App\Http\Controllers;

use App\Repositories\Groups as GroupRepositorty;
use Illuminate\Http\Request;

use App\Competition;
use App\Group;
use App\GroupTeams;
use App\Season;
use App\Stage;
use App\Http\Requests\GroupRequest;


class GroupController extends Controller
{

    public function createGroupsView(Competition $competition, Season $season, Stage $stage)
    {
        return view('season.groups', compact(['competition', 'season', 'stage']));
    }


    public function addGroups(Competition $competition, Season $season, Stage $stage, GroupRequest $request)
    {

        $request->create_groups($stage);

        return redirect('/');
    }


    
    public function addTeamsView(Competition $competition, Season $season, Stage $stage)
    {
        $Teams = $season->registeredTeams;

        $groups = $stage->groups;

        return view('groups.add_teams', compact(['season', 'Teams','groups']));
    }

    public function addGroupTeams(Competition $competition, Season $season, Stage $stage, GroupRepositorty $groupRepo, GroupRequest $request)
    {
        foreach ($request->get('groupTeams') as $group_id => $teams) {

            $group = Group::find($group_id);
            
            if(count($teams) < $group->teams_number){
                return "false";
            }

            foreach ($teams as $team_id => $value) {
            
                $groupRepo->addGroupTeams($group, $team_id);
            
            }
 
        }

    }




    public function showGroupTeams(Competition $competition, Season $season, Stage $stage)
    {
        
        $groups = $stage->groups;

        return view('groups.all-groups', compact('groups'));
    }




    // Get All Groups
    /**
     * @SWG\Get(
     *     path="/api/Seasons/{season}/stages/{stage}/groups",
     *     description = "get all groups",
     *     produces={"application/json"},
     *     operationId="AllGroups",
     *     tags={"groups"},
     *     @SWG\Parameter(
     *          name="season",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Season ID",
     *      ),
     *      @SWG\Parameter(
     *          name="stage",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="stage ID",
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
    public function findAllGroups(Season $season, Stage $stage){
        $stage = $season->stages()->find($stage->id);
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

    /**
     * @SWG\Get(
     *     path="/api/Seasons/{season}/stages/{stage}/groups/{group}",
     *     description = "get single group",
     *     produces={"application/json"},
     *     operationId="findGroup",
     *     tags={"groups"},
     *     @SWG\Parameter(
     *          name="season",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Season ID",
     *      ),
     *      @SWG\Parameter(
     *          name="stage",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="stage ID",
     *      ),
     *      @SWG\Parameter(
     *          name="group",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="group ID",
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
    public function findOne(Season $season, Stage $stage , Group $group){
        $stage = $season->stages()->find($stage->id);
        $group = $stage->groups()->find($group->id);
        
        if(!$group){
            return response()->json([
                'Message' => 'Group Not Found'], 404);
        }

        return response()->json([
            'Message' => 'This Season have this group',
            'Groups information' => $group
        ],200);
    }


    // Create Stage Groups 
     /**  @SWG\Post(
     *     path="/api/Seasons/{season}/stages/{stage}/groups",
     *     description = "create groups",
     *     produces={"application/json"},
     *     operationId="addGroup",
     *     tags={"groups"},
     *     @SWG\Parameter(
     *          name="season",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Season ID",
     *      ),
     *     @SWG\Parameter(
     *          name="stage",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="stage ID",
     *      ),
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          schema={"$ref":"#/definitions/group"},
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
    public function createGroups(Season $season, Stage $stage, GroupRequest $request)
    {
        $competition = \App\Competition::find($season->comp_id);
        
        $stage = $season->stages()->find($stage->id);

        if(Group::where('stage_id', $stage->id)->first()){
            return response()->json(['Message' => 'Groups Are already created'], 400);
        }

        $response = $request->create_groups($stage);

        return $response;
    }




    // Add Teams To a Group
     /**  @SWG\Post(
     *     path="/api/Seasons/{season}/stages/{stage}/groups/{group}/teams",
     *     description = "Add Teams to a group",
     *     produces={"application/json"},
     *     operationId="addGroupTeams",
     *     tags={"groups"},
     *     @SWG\Parameter(
     *          name="season",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Season ID",
     *      ),
     *     @SWG\Parameter(
     *          name="stage",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="stage ID",
     *      ),
     *      @SWG\Parameter(
     *          name="group",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="group ID",
     *      ),
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          schema={"$ref":"#/definitions/groupTeam"},
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
    public function AddTeams(Season $season, Stage $stage, Group $group, GroupRepositorty $groupRepo)
    {
        $this->validate(request(), [
            'team_id' => [
                'required',
                'exists:registered_teams,id,season_id,'. $season->id,
                'unique:group_teams,register_team_id,NULL,NULL,group_id,'. $group->id
            ]
        ]);
       
        $response = $groupRepo->addGroupTeams($group, Request('team_id'));

        return $response;

    }



    //Delete Group

     /**  @SWG\Delete(
     *     path="/api/Seasons/{season}/stages/{stage}/groups/{group}/delete",
     *     description = "Delete group",
     *     produces={"application/json"},
     *     operationId="deleteGroups",
     *     tags={"groups"},
     *     @SWG\Parameter(
     *          name="season",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="Season ID",
     *      ),
     *     @SWG\Parameter(
     *          name="stage",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="stage ID",
     *      ),
     *      @SWG\Parameter(
     *          name="group",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="group ID",
     *      ),
     *      @SWG\Response(
     *         response = 204,
     *         description = "SUCCESSFULLY Deleted"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     *     
     * )
     */
    public function delete(Season $season, Stage $stage, Group $group){
        $stage = $season->stages()->find($stage->id);
        $group = $stage->groups()->find($group->id);
        if (!$group) {
            return response()->json([
                'Message' => 'this group is not exist'
            ], 404);
        }
        if (!$group->delete()) {
            return response()->json([
                'Message' => 'this group can not be deleted X-X'
            ], 402);
        }
        return response()->json([
            'Message' => 'group deleted successfully'
        ], 204);
    }


}
