<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompetitionRequest;

use Illuminate\Http\Request;
use App\Competition;
use App\continent;
use App\Country;
use App\Http\Resources\CompetitionResource;

class CompetitionsController extends Controller
{

    public function __construct(){
       $this->middleware('auth')->except(['All_Competitions_View']);
    }
    //create view for competition
    public function Create_View()
    {
       $all_countries = Country::all();
       $all_continents = continent::all();

       return view('Competition.create',compact(['all_countries','all_continents']));

    }

    public function createCompetition(CompetitionRequest $request)
    {   
        $competition = $request->store();

        return redirect('/competitions');

    }

    public function All_Competitions_View()
    {
        $Competitions = Competition::all();
        return view('Competition.all_Competitions',compact('Competitions'));
    }
    
    public function Specific_Competition_View(Competition $Competition)
    {
        $Seasons_Competition = $Competition->seasons()->get();
        return view('Competition.specific_Competition',compact('Competition','Seasons_Competition'));
    }

}
