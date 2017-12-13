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
            'season' => $this->season_id,
            'stage' => $this->stage_id,
            'team 1' => $this->register_team_1_id,
            'team 2' => $this->register_team_2_id,
            'match date' => $this->date,
            'match time' => $this->time,
            'match stadium' =>$this->stadium,
            'winner of the match ' =>$this->winner_id,
            'first team number of goals' =>$this->team_1_goals,
            'second team number of goals' =>$this->team_2_goals,
            'number of yellow cards in match' =>$this->yellow_cards,
            'number of red cards in match' =>$this->red_cards,
        ];
    }
}
