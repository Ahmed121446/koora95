<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CountryResource extends Resource
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
            'country name' => $this->name,
            'Continent name' => $this->continent->name
        ];

    }
}
