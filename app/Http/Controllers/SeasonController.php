<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

use App\Season;
use App\Repositories\SeasonRepository;
use App\Competition;
use App\Stage;
use App\Team;
use App\RegisteredTeam;
use App\Week;
use App\Round;
use App\Country;
use App\continent;
use App\Http\Requests\AddSeasonRequest;
use App\Http\Resources\SeasonResource;

class SeasonController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function create(Competition $competition, Request $request)
    {
        $seasonRepo = new SeasonRepository;
        $season = $seasonRepo->store($request, $competition);

        if($request->get('is_grouped')){
            $stage = $season->stages()->where('name','group stage')->first();
            $url = 'competitions/'. $competition->id . "/seasons" .'/'. $season->id . '/groups/create';
            
            return redirect($url);
        }

        return redirect('competitions/' . $competition->id . "/seasons/" . $season->id);
    }

    public function Specific_Season_View(Competition $competition, Season $season)
    {
        $RTeams = $season->registeredTeams()->orderByRaw('min(points) desc')->get();
        $location = $competition->location;

        if (!$location instanceof Country) {
            $Teams = [];
            $countries = Country::where('continent_id',$location->id)->get();
            foreach ($countries as $country) {
                $teams = Team::where('country_id',$country->id)->get();
                foreach ($teams as $team ) {
                    if(!$RTeams->find($team->id)){
                        array_push($Teams,$team);
                    }
                }
            } 
        }else{
            $Teams = Team::where('country_id',$location->id)->get();
        }

        return view('season.specific_Season',compact('season','Teams','RTeams'));
    }


    public function createGroups(Request $request)
    {
        return view('season.groups');
    }


    public function allStages()
    {
        $season_id = $_GET['season_id'];

        $season = Season::find($season_id);

        return $season->stages; 

        // return Stage::all();
    }


    public function findStageRounds()
    {
        $stage_id = $_GET['stage_id'];
        $stage = Stage::find($stage_id);
        
        $rounds = $stage->groupRounds;

        return $rounds;

    }


    public function findStageData()
    {
        $stage_id = $_GET['stage_id'];
        $stage = Stage::find($stage_id);
        
        $groups = $stage->groups;
        $rounds = $stage->groupRounds;

        return ['groups' => $groups, 'rounds' => $rounds];

    }


    public function addStage(Competition $competition, Season $season, Request $request)
    {
        $stage = new Stage(['name' => $request->get('name')]);
        $season->stages()->save($stage);

        return back();
    }

}
