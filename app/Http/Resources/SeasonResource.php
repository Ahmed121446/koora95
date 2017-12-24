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
        //make the shape of the Season data  that will be returned
        //json shape
        return [
            //return season name 
            'Season' =>$this->name,
            //return true or false according to the seasion is active or not  
            'active' => ($this->active) ? 'true' : ' false' ,
            'For Competition'=>[
                //return Competition name from competiton()->function in Season model
                ' name' =>$this->competiton->name
            ],
        ];
    }
}
