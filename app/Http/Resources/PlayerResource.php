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
        return [
            'Player name' =>$this->name,
            'Player position' =>$this->position,
            'player team' =>[
                'team name' => $this->Team->name,
                'team country' => $this->Team->country->name
            ],
            'player country' =>[
                'country name' => $this->country->name,
                'country position' => $this->country->continent->name
                
            ]
        ];
    }
}
