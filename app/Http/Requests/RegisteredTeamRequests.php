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
                    'team_name' => 'required'
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

        $teams = $this->get('team_name');

        foreach ($teams as $team_id) {
            $team = new RegisteredTeam();
            $team->team_id = (int)$team_id; 
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
        }

    }
}
