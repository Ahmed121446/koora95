<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
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
        return [
            'groups_number' => 'required|numeric',
            'teams_number' => 'required|numeric',
            'home_away' => 'boolean'
        ];
    }


    public function create_groups(Competition $competition ,Stage $stage)
    {
        $groups_number = $this->get('groups_number');
        $teams_number = $this->get('teams_number');

        if($this->get('home_away') || $competition->is_cup()){
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

            if (!$stage->groups()->save($group)) {
                return response()->json([
                    'Message' => 'An Error Occured'  
                ], 500);
            }

        }

        $stage->addRounds($rounds_number);
       
        return $stage->groups;
    }


    
}
