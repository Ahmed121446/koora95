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
        return [
            'Register Player Information'=>[
                'Register player id' => $this->id,
                'Player Information' =>[
                    'player id' => $this->player->id,
                    'player name' => $this->player->name,
                    'country name' => $this->player->country->name,
                    'player position' => $this->player->position,
                    'Static Team Information' =>[
                        'Team id' =>$this->player->Team->id,
                        'Team name' =>$this->player->Team->name
                    ]
                ],
                'In Competition'=>[
                    'Competition name' => $this->registeredTeam->seasons->competiton->name,
                    'season'=>[
                       'Season id'=> $this->registeredTeam->seasons->id,
                       'Season name'=> $this->registeredTeam->seasons->name,
                       'Register Team Information'=>[
                            'Register Team id' =>$this->registeredTeam->id,
                            'Register Team name' =>$this->registeredTeam->team->name,
                            'Register Team country' =>[
                                'country id' => $this->registeredTeam->seasons->competiton->location->id,
                                'country name' => $this->registeredTeam->seasons->competiton->location->name,
                            ]
                        ]
                    ]
                ]
                
            ]
        ];
    }
}
