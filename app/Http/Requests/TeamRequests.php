<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequests extends FormRequest
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
            'name'          =>  'required|min:2|max:25',
            'type_id'       =>  'required|numeric',
            'logo'          =>  'required',
            'stadium'       =>  'required|min:2|max:25',
            'country_id'    =>  'required|numeric|unique:teams,name|unique:teams,country_id'
        ];
    }
}
