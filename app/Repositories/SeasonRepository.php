<?php

namespace App\Repositories;

use Illuminate\Http\Request;

use App\Competition;
use App\Season;
use App\Stage;
use App\Group;
use App\GroupRound;
/**
* 
*/
class SeasonRepository
{
    protected $season;
    protected $teams_number;


    public function store(Request $request, Competition $competition)
    {
        $name = $request->get('name');
        $is_grouped = $request->get('is_grouped');
        $this->teams_number = $request->get('teams_number');
        
        $is_active = 0;
        if($request->get('is_active')){
            $is_active = $request->get('is_active');
        }

        $season = new Season();
        $season->name = $name;
        $season->active = $is_active;
        $season = $competition->seasons()->save($season);

        $this->season = $season;
        $this->createStages($competition, $is_grouped);

        return $season;
    }

    private function createStages(Competition $competition, $is_grouped)
    {

        if($competition->is_league()){
            $this->leagueStages($is_grouped);
        }else{
            $this->cupStages();
        }
    }

    private function cupStages()
    {
        $season = $this->season;

        $stages = [
            'first stage', 'round of 64', 'round of 32', 'round of 16', 'round of 8', 'round of 4' , 'final'
        ];

        for ($round=0; $round < 6; $round++) { 
            $stage = new Stage([
                'name' => $stages[$round]
            ]);

            $season->stages()->save($stage);
        }
        
    }

    private function leagueStages($is_grouped)
    {
        $season = $this->season;

        if(!$is_grouped){
            $teams_number = $this->teams_number;
            $weeks = ($teams_number -1) * 2;
            for ($week=1; $week <= $weeks ; $week++) { 
                $stage = new Stage([
                    'name' => 'week '. $week
                ]);

                $season->stages()->save($stage);
            }
        }else{
            $stage = new Stage([
                    'name' => 'group stage'
                ]);
            $season->stages()->save($stage);
        }
    }
}