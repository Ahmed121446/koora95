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
            'Match id' => $this->id,
            //return season name from season()->function in match model

            'season' => $this->season->name,
            'stage' => [
                            //return stage id  from stage()->function in match model
                            'id' =>$this->stage->stage_id,
                            //return stage type  from stage()->function in match model
                            'Type' =>$this->stage->stage_type
                        ],
            'team 1' => [
                            //return first team name from team1()->function in match model
                            'name'=> $this->team1->name,
                            //return country name from team1()->function in match model
                            //and from country() ->function in Team model
                            'country'=>[
                                'name' => $this->team1->country->name
                            ] 
                        ],
            'team 2' => [
                            //return second team name from team2()->function in match model
                            'name'=> $this->team2->name,
                            //return country name from team2()->function in match model
                            //and from country() ->function in Team model
                            'country'=>[
                                'name' => $this->team2->country->name
                            ] 
                        ],
            //return match date 
            'match date' => $this->date,
            //return match time  
            'match time' => $this->time,

            'status' => $this->status,
            //return match stadium 
            'match stadium' =>$this->stadium,
            'winner' =>[
                                        //return match winner name 
                                       'name' =>optional($this->winner)->name
                                    ],
            //return match first team goals 
            'first team goals' =>$this->team_1_goals,
            //return match second team goals 
            'second team goals' =>$this->team_2_goals,
            //return match yellow cards  
            'yellow cards' =>$this->yellow_cards,
            //return match red cards  
            'red cards' =>$this->red_cards,

        ];
    }
}
