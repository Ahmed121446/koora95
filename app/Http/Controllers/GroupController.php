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

    public function __construct(){
        $this->middleware('auth');
    }
    //view create Groups form
    public function createGroupsView(Competition $competition, Season $season)
    {
        return view('groups.create', compact(['competition', 'season']));
    }


    // Add groups to a season
    public function addGroups(Competition $competition, Season $season, GroupRequest $request)
    {

        $request->create_groups($season);

        $url = '/competitions/' . $competition->id . '/seasons/'. $season->id;
        $url .= '/groups/'.$request->get('stage_id').'/teams/create';
        
        return redirect($url);
    }




    // view the form of adding teams to groups
    public function addTeamsView(Competition $competition, Season $season, Stage $stage)
    {
        $Teams = $season->registeredTeams;

        $groups = $stage->groups;

        return view('groups.add_teams', compact(['season', 'Teams','groups']));
    }


    // Add Teams To the Group
    public function addGroupTeams(Competition $competition, Season $season, Stage $stage, GroupRepositorty $groupRepo, GroupRequest $request)
    {
        foreach ($request->get('groupTeams') as $group_id => $teams) {

            $group = Group::find($group_id);
            
            if(count($teams) < $group->teams_number){
                return back()->withErrors("
                    Number of teams you've added is less than the required number"
                );
            }

            foreach ($teams as $team_id => $value) {
            
                $groupRepo->addGroupTeams($group, $team_id);
            
            }
 
        }

        $url  = '/competitions/' . $competition->id . '/seasons/' . $season->id . '/stages/' . $stage->id . '/groups';

        return redirect($url);

    }




    // Show all Groups
    public function showGroups(Competition $competition, Season $season, Stage $stage)
    {
        $stage = $season->GroupStage();
        $groups = $stage->groups;

        return view('groups.all-groups', compact(['groups','stage']));
    }


}
