<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\RegisteredTeam;
use App\Season;

class RegisteredTeamRequests extends FormRequest
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
                    'team_id' => [
                        'required',
                        'numeric',
                        'unique:registered_teams,team_id',
                        'unique:registered_teams,season_id'
                    ]
                ];
            }
            default: return [];
        }
    }


    public function store(Season $season)
    {
        if(!$season->active){  
            return response()->json(["message" => "Season is Ended"]); 
        }
        $team = new RegisteredTeam([
            'team_id' => $this->get('team_id'), 
            'played' => 0, 
            'wins'=> 0, 
            'losses' => 0, 
            'draws' => 0, 
            'goals_for' => 0, 
            'goals_against' => 0,
            'points' => 0,
            'red_cards' => 0,
            'yellow_cards' => 0

        ]);

        $team = $season->registeredTeams()->save($team);

        return $team;
    }
}
