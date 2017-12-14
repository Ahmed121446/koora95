<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class SeasonResource extends Resource
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
            'Season' =>$this->name,
            'Season is active' => ($this->active) ? 'true' : ' false' ,
            'For Competition'=>[
                'Competition name' =>$this->competiton->name
            ],
        ];
    }
}
