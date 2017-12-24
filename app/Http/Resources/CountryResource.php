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
            //make the shape of the country data  that will be returned
            //json shape
            'country name' => $this->name,
            'Continent' => [
                'name' => $this->continent->name
            ]
        ];

    }
}
