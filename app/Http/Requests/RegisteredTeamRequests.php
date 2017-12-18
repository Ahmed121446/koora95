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
        $season_id = $this->season->id;
        switch ($this->method())
        {
            case 'POST':
            {
                return [
                    'team_id' => [
                        'required',
                        'numeric',
                        'unique:registered_teams,team_id,NULL,NULL,season_id,' . $season_id
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
        $team = new RegisteredTeam();
        $team->team_id = $this->get('team_id'); 
        $team->played = 0; 
        $team->wins= 0; 
        $team->losses = 0; 
        $team->draws = 0; 
        $team->goals_for = 0; 
        $team->goals_against = 0;
        $team->points = 0;
        $team->red_cards = 0;
        $team->yellow_cards = 0;
        $team = $season->registeredTeams()->save($team);

        if(!$team){
            return response()->json(['message' => 'An Error Occured'], 500);
        }

        return $team;
    }
}
