<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMatchRequest extends FormRequest
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
                'date' => 'required|date',
                'time' => 'required',
                'stage_id' => 'numeric',
                'team_1_id' => [
                    'required',
                    'numeric',
                    'exists:registered_teams,id,season_id,'. $this->get('season_id'),
                ],
                'team_2_id' => [
                    'required',
                    'numeric',
                    'different:team_1_id',
                    'exists:registered_teams,id,season_id,'. $this->get('season_id')
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
}
