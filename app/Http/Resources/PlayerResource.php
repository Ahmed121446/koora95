<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PlayerResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //make the shape of the player data  that will be returned
        //json shape
        return [
            //return player name
            'Player name' =>$this->name,
            //return player position
            'Player position' =>$this->position,
            'player team' =>[
                //return player team name from Team()->function in player model
                'team name' => $this->Team->name,
                //return player team country name from Team()->function in player model
                //and from country()->function in team model
                'team country' => $this->Team->country->name
            ],
            'player country' =>[
                //return player country name from country()->function in player model
                'country name' => $this->country->name,
                //return player country continent name from country()->function in player model
                //and from continent()->function in country model
                'country position' => $this->country->continent->name
            ]
        ];
    }
}