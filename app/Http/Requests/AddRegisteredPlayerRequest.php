<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
                   'registered_team_id' => 'required|numeric',
                    'player_id' => 'required|numeric'
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
    
}
