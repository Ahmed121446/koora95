<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchRequest;
use App\Http\Requests\CreateMatchRequest;

use App\Repositories\Matches as MatchesRepo;
use App\Http\Resources\MatchResource  ;
use Image;
use Storage;


use Illuminate\Http\Request;
use App\Match;
use App\Season;
use App\Team;
use Carbon\Carbon;
use App\RegisteredTeam;
use App\Stage;
use App\Group;
use App\competition;


class MatchesController extends Controller
{
    public function __construct(){
       $this->middleware('auth')->except(['Get_Today_Matches_View','ALL_matches_View']);
    }
    public function getTeams(Request $request){

        $Rteams_names =[];

        if($request->has('season_id') && $request->get('season_id') != 0){
            $season_id = $request->get('season_id');
            $season = Season::find($season_id);
            $teams = $season->registeredTeams;
            foreach ($teams as $team ) {
                $Rteams_names[$team->id] = $team->team->name;
            }
            return $Rteams_names;
        }else if($request->has('group_id') && $request->get('group_id') != 0) {
            $group_id = $request->get('group_id');
            $group = Group::find($group_id);
            $teams = $group->groupTeams;
            foreach ($teams as $team ) {
                $Rteams_names[$team->register_team_id] = $team->registeredTeam->team->name;
            }
            return $Rteams_names;
        }else{
            $teams = RegisteredTeam::where('season_id', 0)->get();
            foreach ($teams as $team ) {
                 $Rteams_names[$team->id] = $team->team->name;
            }
            return  $Rteams_names;
        }
        

    }
    public function ALL_matches_View(Request $request){

        $seasons = Season::where('active', 1)->get();

        $all_matches = Match::filter($request->all())->paginate(10);

        if($request->has('season') && $request->get('season') != 0){
            $stages = Season::find($request->get('season'))->stages;
        }
        if($request->has('stage') && $request->get('stage') != 0){
            $rounds = Stage::find($request->get('stage'))->groupRounds;
        }

        return view('match.all_Matches',compact(['all_matches', 'seasons', 'stages', 'rounds']));
    
    }
    public function Create(CreateMatchRequest $request){
        $group_id = ($request->has('group_id')) ? $request->get('group_id') : null ;
        $group_round_id = ($request->has('group_round')) ? $request->get('group_round') : null ;
        $stage_id = ($request->get('season_id') > 0 ) ? $request->get('stage_id') : 0 ;

        $match =  new Match([
            'date'  => $request->get('date'),
            'time' => $request->get('time'),
            'stage_id' => $stage_id,
            'group_round_id' => $group_round_id,
            'group_id' => $group_id,
            'season_id' => $request->get('season_id'),
            'register_team_1_id' => $request->get('team_1_id'),
            'register_team_2_id' => $request->get('team_2_id'),
            'stadium' => $request->get('stadium'),
            'status' => "Not Played",
            'team_1_goals' => 0,
            'team_2_goals' => 0,
            'winner_id' => 0,
            'red_cards' => 0,
            'yellow_cards' => 0
        ]);
        $match->save();
        return redirect()->route('home');
    }

    public function Get_Today_Matches_View(){
       $today = Carbon::now();
        $today = $today->toDateString();
        $matches = Match::where('date',$today)->get();

        $competitions = $matches->groupBy(function ($item, $key) {
            if ($item->season == null) {
                return "friendly matches";
            }else{
                return $item->season->competition->name;
            }
        });
        return view('welcome',compact('competitions'));
    }

    public function Add_Match_View()
    {
        $season = Season::where('active',1)->get();
        $competitions = $season->groupBy(function ($item, $key) {
            return $item->competition->name;
        });

        return view('match.create',compact('competitions'));
    }

    public function remove_match($id){
        $find_match = Match::find($id);
        $find_match->delete();
        return redirect()->back();
    }

    public function update_match($match_id,Request $request){
       $find_match = Match::find($match_id);
        if(!$find_match){
            return  'Match not found';
        }
        $this->validate($request,[
            'stadium' => 'required|min:2|max:25'
        ]);
        $find_match->date            = $request->get('date');
        $find_match->time            = $request->get('time');
        $find_match->stadium         = $request->get('stadium');
        $find_match->team_1_goals    = $request->get('FTG');
        $find_match->team_2_goals    = $request->get('STG');
        $find_match->red_cards       = $request->get('red');
        $find_match->yellow_cards    = $request->get('yellow');
        if (!$find_match->update()) {
            return "match can not be updated";
        }
        return "match updated successfully";
    } 


    public function updateLive(Match $match,Request $request)
    {
        
        $match->team_1_goals = $request->get('team_1_goals');
        $match->team_2_goals = $request->get('team_2_goals');
        
        $match->save();

        return redirect('/matches'.'/'.$match->id);
    }


    public function updateStatus(Match $match,Request $request, MatchesRepo $matchRepo)
    {
        if($match->status == "Not Played"){
            $match->status = "InProgressed";
            $match->save();
        }else if($match->status == "InProgressed"){
            $season = $match->season;
            $matchRepo->endMatch($season, $match);
        }
        
        

        return redirect('/matches'.'/'.$match->id);
    }




    public function Get_S_Match(Match $match){
        $team1_image = $match->Team1->logo;
        $image1 = Image::make(Storage::get('public/images/teams-logos/'.$team1_image))->resize(110,110);
        $team2_image = $match->Team2->logo;
        $image2 = Image::make(Storage::get('public/images/teams-logos/'.$team2_image))->resize(110,110);
        
        $img = Image::canvas(1200, 350, '#1f1f1f');
        $img->insert($image1, 'top-left',200,160);
        $img->insert($image2, 'top-right',200,160);

        //match Stadium
        $img->text("Stadium : ".$match->stadium, 50, 40, function($font) {
            $font->file('font/Raleway-Light.ttf');
            $font->color(array(255, 255, 255, 1));
            $font->size(18);
        });
        //match red_cards
        $img->text("| Red Cards : ".$match->red_cards, 260, 40, function($font) {
            $font->file('font/Raleway-Light.ttf');
            $font->color(array(200, 30, 45, 1));
            $font->size(15);
        });
        //match yellow_cards
        $img->text("| Yellow Cards : ".$match->yellow_cards, 370, 40, function($font) {
            $font->file('font/Raleway-Light.ttf');
            $font->color(array(255, 219, 87, 0.8));
            $font->size(15);
        });


        //white line
        $img->line(20, 60, 1180, 60, function ($draw) {
            $draw->color('#fff');
        });

        //first team name
        $img->text($match->Team1->name, 80, 220, function($font) {
            $font->file('font/yanonekaffeesatz-regular-webfont.ttf');
            $font->color(array(255, 255, 255, 1));
            $font->size(25);
        });
        //second team name
        $img->text($match->Team2->name, 1020, 220, function($font) {
            $font->file('font/yanonekaffeesatz-regular-webfont.ttf');
            $font->color(array(255, 255, 255, 1));
            $font->size(25);
        });
        //second team goals
        $img->text($match->team_2_goals, 850, 220, function($font) {
            $font->file('font/yanonekaffeesatz-regular-webfont.ttf');
            $font->color(array(255, 255, 255, 1));
            $font->size(30);
        });
        //first team goals
        $img->text($match->team_1_goals, 330, 220, function($font) {
            $font->file('font/yanonekaffeesatz-regular-webfont.ttf');
            $font->color(array(255, 255, 255, 1));
            $font->size(30);
        });

         //competition name
        $competition_name = ($match->season_id ==0) ? 'Friendly Match' : $match->season->competition->name ; 
        $img->text($competition_name, 490, 150, function($font) {
            $font->file('font/PoiretOne-Regular.ttf');
            $font->color(array(255, 255, 255, 1));
            $font->size(40);
        });
        //season name
        $season_name = ($match->season_id ==0) ? '' : $match->season->name ; 
        $img->text($season_name, 560, 200, function($font) {
            $font->file('font/PoiretOne-Regular.ttf');
            $font->color(array(255, 255, 255, 1));
            $font->size(30);
        });

        //match time
        $time = ($match->status == "Not Played") ? $match->time : '';
        $img->text($time, 595, 260, function($font) {
            $font->file('font/PoiretOne-Regular.ttf');
            $font->color(array(169, 68, 66, 1));
            $font->align('center');
            $font->size(20);
        });

        //match status
        $img->text($match->status, 595, 300, function($font) {
            $font->file('font/Cairo-Regular.ttf');
            $font->color(array(169, 68, 66, 1));
            $font->align('center');
            $font->size(20);
        });
        

        $path = storage_path('app/public/images/matches/');

        $matchLogo = $match->id . '.png';


        $img->save($path.''.$matchLogo);

        return view('match.specific_match', compact(['match','matchLogo']));
    }


}
