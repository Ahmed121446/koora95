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
        return [
            'season' => $this->season->name,
            'stage' => [
                            'Stage Type id' =>$this->stage->stage_id,
                            'Stage Type' =>$this->stage->stage_type
                        ],
            'team 1' => [
                            'name'=> $this->team1->name,
                            'country name'=> $this->team1->country->name
                        ],
            'team 2' => [
                            'name'=> $this->team2->name,
                            'country name'=> $this->team2->country->name
                        ],
            'match date' => $this->date,
            'match time' => $this->time,
            'match stadium' =>$this->stadium,
            'winner of the match ' =>[
                                       'Winner' =>optional($this->winner)->name
                                    ],
            'first team number of goals' =>$this->team_1_goals,
            'second team number of goals' =>$this->team_2_goals,
            'number of yellow cards in match' =>$this->yellow_cards,
            'number of red cards in match' =>$this->red_cards,
        ];
    }
}
