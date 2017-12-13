<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Group;
use App\Stage;

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
            'groups_number' => 'required|numeric'
        ];
    }


    public function create_groups(Stage $stage)
    {
        $groups_number = $this->get('groups_number');

        $start = ord('A');
        $end = ord('A')+ $groups_number;

        for ($i = $start; $i < $end; $i++) { 
            $new_group = new Group();
            $new_group->name = chr($i);

            if ($group = !$stage->groups()->save($new_group) ) {
                return response()->json([
                    'Message' => 'An Error Occured'  
                ], 500);
            }
        }
       
        return $stage->groups;
    }


    
}
