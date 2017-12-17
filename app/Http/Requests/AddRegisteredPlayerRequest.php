<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Season;
use App\RegisteredTeam;
use App\RegisteredPlayer;

class AddRegisteredPlayerRequest extends FormRequest
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


         switch ($this->method())
        {
            case 'POST':
            {
                return [
                    'player_id' => [
                        'required',
                        'numeric',
                        'unique:registered_players,player_id,NULL,NULL,registered_team_id,' . $this->team->id
                    ]
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'registered_team_id' => 'required|numeric',
                    'player_id' => 'required|numeric',
                    'played' => 'required|numeric',
                    'goals' => 'required|numeric',
                    'assists' => 'required|numeric',
                    'red_cards' => 'required|numeric',
                    'yellow_cards' => 'required|numeric'
                ];
            }
            default: return [];
        }
    }     



    public function addPlayer(Season $season, RegisteredTeam $team)
     {

        $player_id = $this->get('player_id');

        $registered_player = new RegisteredPlayer();
        $registered_player->player_id = $player_id;
        $registered_player->played = 0;
        $registered_player->goals = 0;
        $registered_player->assists = 0;
        $registered_player->red_cards = 0;
        $registered_player->yellow_cards = 0;

        $team = $season->registeredTeams()->find($team)->first();
        $player = $team->registeredPlayers()->save($registered_player);

        return $player;
     } 
    
}
