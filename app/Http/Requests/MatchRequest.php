<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Season;
use App\Match;
use App\Stage;

class MatchRequest extends FormRequest
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
                'date' => 'required|date|after:today',
                'time' => 'required',
                'stage_id' => 'required|numeric',
                'team_1_id' => [
                    'required',
                    'numeric',
                    'exists:registered_teams,id,season_id,'. $this->season->id,
                ],
                'team_2_id' => [
                    'required',
                    'numeric',
                    'different:team_1_id',
                    'exists:registered_teams,id,season_id,'. $this->season->id
                ],
                'stadium' => 'required|min:2|max:25',
                'group_round_id' => [
                    'required_with:group_id',
                    'exists:group_rounds,id,stage_id,'. $this->get('stage_id')
                ],
                'group_id' => [
                    'required_with:group_round_id',
                    'exists:groups,id,stage_id,'. $this->get('stage_id')
                ],

        ];
        
    }


    public function add(Season $season)
    {
        $group_round = NULL;
        $group_id = NULL;
        $stage = Stage::find($this->get('stage_id'));

        if($this->get('group_round_id') && $stage->has_groups()){ 
            $group_round = $this->get('group_round_id');
            $group_id = $this->get('group_id');
        }
        
        $match =  new Match([
            'date'  => $this->get('date'),
            'time' => $this->get('time'),
            'stage_id' => $this->get('stage_id'),
            'group_round_id' => $group_round,
            'group_id' => $group_id,
            'register_team_1_id' => $this->get('team_1_id'),
            'register_team_2_id' => $this->get('team_2_id'),
            'stadium' => $this->get('stadium'),
            'status' => "Not Played Yet",
            'team_1_goals' => 0,
            'team_2_goals' => 0,
            'winner_id' => 0,
            'red_cards' => 0,
            'yellow_cards' => 0
        ]);

        $season->matches()->save($match);

        return $match;
    }
}
