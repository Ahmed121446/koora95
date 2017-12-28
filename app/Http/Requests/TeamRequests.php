<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Team;

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
        switch ($this->method())
        {
            case 'POST':
            {
                return [
                    'name'          =>  [
                        'required',
                        'min:2',
                        'max:25',
                        'unique:teams,name,null,null,country_id,' . $this->country_id,
                    ],              
                    'type'       =>  'required|numeric',
                    'logo' => 'required|image|mimes:jpg,png,jpeg',
                    'stadium'       =>  'required|min:2|max:25',
                    'country_id'    =>  'required|numeric'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name'          =>  'required|min:2|max:25',
                    'type_id'       =>  'required|numeric',
                    'logo'          =>  'required',
                    'stadium'       =>  'required|min:2|max:25',
                    'country_id'    =>  [
                        'required',
                        'numeric',
                        Rule::unique('teams','country_id')->where(function ($query) {
                            return $query->where('name', $this->get('name'));
                        })->ignore(2)
                    ]
                ];
            }
            default: return [];
        }
    }

    public function store()
    {
        $name = $this->get('name');
        $type_id = $this->get('type');
        $stadium = $this->get('stadium');
        $country_id = $this->get('country_id');

        $logoName  = $name .'.'.$this->file('logo')->extension();
        $this->file('logo')->storeAs('public/images/teams-logos', $logoName);


        $Team = new Team();
        $Team->name         = $name;
        $Team->type_id      = $type_id;
        $Team->logo         = $logoName;
        $Team->stadium      = $stadium;
        $Team->country_id   = $country_id;

        $Team->save();
        return $Team;
    }      
}
