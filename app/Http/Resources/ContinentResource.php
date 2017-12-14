<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ContinentResource extends Resource
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
            'Continent id' => $this->id,
            'Continent Name' => $this->name
        ];
    }
}
