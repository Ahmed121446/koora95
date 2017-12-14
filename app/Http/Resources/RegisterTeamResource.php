<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class RegisterTeamResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //make the shape of the Register Team data  that will be returned
        //json shape
        return [
            //return Register team information
            //return Season information of this Register team
            'Register Team Information' =>[
                'Register team id' => $this->id,
                'team id' => $this->team->id,
                'team name' => $this->team->name,
                'team country' => $this->team->country->name,
                'team Continent' => $this->team->country->continent->name,
                'Season Information' =>[
                    'Season' => $this->seasons->name,
                    'Season in Competition' => [
                       'name'=> $this->seasons->competiton->name
                    ]
                ],
                'points ' =>$this->points,
                'Number for matches played' =>$this->played,
                'Number for matches wins' =>$this->wins,
                'Number for matches losses' =>$this->losses,
                'Number for matches draws' =>$this->draws,
                'Number of goals for this team ' =>$this->goals_for,
                'Number of goals against this team' =>$this->goals_against,
                'Number of red cards for this team ' =>$this->red_cards,
                'Number of yellow cards against this team' =>$this->yellow_cards,
            ]

        ];
    }
}
