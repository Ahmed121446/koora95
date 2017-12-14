<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MatchResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //make the shape of the match data  that will be returned
        //json shape
        return [
            //return season name from season()->function in match model
            'season' => $this->season->name,
            'stage' => [
                            //return stage id  from stage()->function in match model
                            'Stage Type id' =>$this->stage->stage_id,
                            //return stage type  from stage()->function in match model
                            'Stage Type' =>$this->stage->stage_type
                        ],
            'team 1' => [
                            //return first team name from team1()->function in match model
                            'name'=> $this->team1->name,
                            //return country name from team1()->function in match model
                            //and from country() ->function in Team model
                            'country name'=> $this->team1->country->name
                        ],
            'team 2' => [
                            //return second team name from team2()->function in match model
                            'name'=> $this->team2->name,
                            //return country name from team2()->function in match model
                            //and from country() ->function in Team model
                            'country name'=> $this->team2->country->name
                        ],
            //return match date 
            'match date' => $this->date,
            //return match time  
            'match time' => $this->time,
            //return match stadium 
            'match stadium' =>$this->stadium,
            'winner of the match ' =>[
                                        //return match winner name 
                                       'Winner' =>optional($this->winner)->name
                                    ],
            //return match first team goals 
            'first team number of goals' =>$this->team_1_goals,
            //return match second team goals 
            'second team number of goals' =>$this->team_2_goals,
            //return match yellow cards  
            'number of yellow cards in match' =>$this->yellow_cards,
            //return match red cards  
            'number of red cards in match' =>$this->red_cards,
        ];
    }
}
