<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CompetitionResource extends Resource
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
            'Competition name' => $this->name,
            'Competition type' => [
                'Competition type name ' =>$this->competitionType->name
            ],
            'location'=>[
                'It will take place in ' =>$this->location->name
            ]

        ];
    }
}
