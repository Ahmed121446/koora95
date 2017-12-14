<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TeamResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //make the shape of the Team data  that will be returned
        //json shape
        return [
            //return team name 
            'Team name' => $this->name,
            //return team stadium name 
            'Team stadium' => $this->stadium,
            'Team type' =>[
                //return team type from  teamType()->function in team model
                'type' => $this->teamType->name
            ],
            'Country' => [
                //return team type from  country()->function in team model
               'Country name'=> $this->country->name
            ]

        ];
    }
}
