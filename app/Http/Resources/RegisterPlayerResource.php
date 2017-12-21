<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class RegisterPlayerResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //make the shape of the Register Player data  that will be returned
        //json shape
        return [
            //return Register Player information
            //Static team information of this player
            'Register Player Information'=>[
                'Register player id' => $this->id,
                'Player Information' =>[
                    ' id' => $this->player->id,
                    ' name' => $this->player->name,
                    ' name' => $this->player->country->name,
                    ' position' => $this->player->position,
                    'Static Team Information' =>[
                        ' id' =>$this->player->Team->id,
                        ' name' =>$this->player->Team->name
                    ]
                ],
                //return Competition information
                //return Season information
                //return Register Team information of this Register player
                'Competition'=>[
                    ' name' => $this->registeredTeam->seasons->competiton->name,
                    'season Information'=>[
                       ' id'=> $this->registeredTeam->seasons->id,
                       ' name'=> $this->registeredTeam->seasons->name,
                       'Register Team Information'=>[
                            ' id' =>$this->registeredTeam->id,
                            ' name' =>$this->registeredTeam->team->name,
                            ' country' =>[
                                ' id' => $this->registeredTeam->seasons->competiton->location->id,
                                ' name' => $this->registeredTeam->seasons->competiton->location->name,
                            ]
                        ]
                    ]
                ]
                
            ]
        ];
    }
}
