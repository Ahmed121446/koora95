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
        return [
            'Team name' => $this->name,
            'Team stadium' => $this->stadium,
            'Team type' =>[
                'type' => $this->teamType->name
            ],
            'Country' => [
               'Country name'=> $this->country->name
            ]

        ];
    }
}
