<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Competition;
use App\Country;
use App\continent;

class CompetitionRequest extends FormRequest
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
                    'name' =>  'required|min:2|max:25',
                    'type' =>  'required|numeric|exists:competition_types,id',
                    'country' => 'required_without:continent|numeric|exists:countries,id',
                    'continent' => 'required_without:country|numeric|exists:continents,id'
                ];
            }
            default: return [];
        }
    }

    // create New Competition
    public function store()
    {
        if($this->get('country')) {
            $country_id = $this->get('country');
            $location = Country::find($country_id);
            
        }else{
            $continent_id = $this->get('continent');
            $location = continent::find($continent_id);
        }
        $competition =  new Competition([
                'name' => $this->get('name'),
                'comp_type_id' => $this->get('type')
            ]);

        if(! $location->competitions()->save($competition)){
            return response()->json(['message' => 'an error occured'], 500);
        }

        return $competition;
    }


    // Update Competiton Data
    public function update(Competition $competition)
    {
        $data = $this->all();

        if(! count($data)){
            return response()->json(['message' => 'There is No inputs']);
        }

        $requested_data = [];

        foreach ($data as $key => $value) {
            switch($key){
                case 'name' : 
                    $requested_data['name'] = $value;
                    break;

                case 'type' : {
                        $type = CompetitionType::where('name', $value)->first();
                        $requested_data['comp_type_id'] = $type->id;
                    }
                    break;
                    
                case 'country' : {
                        $country = CompetitionType::where('name', $value)->first();
                        $requested_data['country_id'] = $country->id;
                    }
                    break;
            
            }
        }

        if(! $competition->update($requested_data)){
            return response()->json(['message' => 'an error occured'], 500);
        }
        
        return $competition;
        
    }
}
