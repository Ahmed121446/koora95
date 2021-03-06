<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Season;
use App\Group;
use App\Stage;
use App\Competition;

class GroupRequest extends FormRequest
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
        
        if($this->get('submit') == 'Add Teams'){
            $groups_number = count($this->stage->groups);

            return [
                'groupTeams' => 'required|size:'. $groups_number
            ];
        }else{
            return [
                'groups_number' => 'required|numeric',
                'teams_per_group' => 'required|numeric',
                'home_away' => 'boolean'
            ];
        }
    }


    public function create_groups(Season $season)
    {
        $stage = $season->stages()->find($this->get('stage_id'));

        $groups_number = $this->get('groups_number');
        $teams_number = $this->get('teams_per_group');

        if($this->get('home_away')){
            $rounds_number = ($teams_number - 1) * 2;
        }else{
            $rounds_number = $teams_number - 1;
        }

        $start = ord('A');
        $end = ord('A')+ $groups_number;

        for ($i = $start; $i < $end; $i++) { 
            $group = new Group();
            $group->name = chr($i);
            $group->teams_number = $teams_number;
            $group->rounds_number = $rounds_number;

            $stage->groups()->save($group);

        }

        $stage->addRounds($rounds_number);
        
    }


    public function messages()
{
    return [
        'groupTeams.size' => 'Please Enter All Group Teams',
       
    ];
}


    
}
