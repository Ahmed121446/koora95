<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\player;

class CreatePlayerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|max:25|min:2',
            'player_position' => 'required|max:3|min:2',
            'team_id' => 'required|numeric',
            'country_id' => 'required|numeric'
        ];
    }


    public function store()
    {
        $name = $this->input('name');
        $position = $this->input('player_position');
        $team_id = $this->input('team_id');
        $country_id = $this->input('country_id');


        $player = new player();
        $player->name = $name;
        $player->position = $position;
        $player->team_id = $team_id;
        $player->country_id = $country_id;
        $player->save();            
    }

}