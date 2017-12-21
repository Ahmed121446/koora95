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
                'name' => $this->team->name,
                'country ' =>[
                   'name'=> $this->team->country->name
                ], 
                ' Continent' =>[
                    'name'=> $this->team->country->continent->name,
                ], 
                'Season Information' =>[
                    'name' => $this->seasons->name,
                    ' Competition' => [
                       'name'=> $this->seasons->competiton->name
                    ]
                ],
                'points ' =>$this->points,
                ' played' =>$this->played,
                ' wins' =>$this->wins,
                ' losses' =>$this->losses,
                ' draws' =>$this->draws,
                'goals for ' =>$this->goals_for,
                'goals against ' =>$this->goals_against,
                'red cards ' =>$this->red_cards,
                'yellow cards ' =>$this->yellow_cards,
            ]

        ];
    }
}
