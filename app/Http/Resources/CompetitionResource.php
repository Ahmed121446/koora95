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

        //make the shape of the Competition data  that will be returned
        ////json shape
        return [
            //return Competition name
            'Competition name' => $this->name,
            //return Competition type from competitionType() ->function in competition model
            'Competition type' => [
                'Competition type name ' =>$this->competitionType->name
            ],
            //return location of this Competition  from location() -> function in competition model
            'location'=>[
                'It will take place in ' =>$this->location->name
            ]

        ];
    }
}
