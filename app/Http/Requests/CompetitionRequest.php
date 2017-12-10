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
        return [
            //
        ];
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

        $location->competitions()->save($competition);
        return $competition;
    }


    // Update Competiton Data
    public function update(Competition $competition)
    {

        $requested_data = [];

        foreach ($this->all() as $key => $value) {
            switch($key){
                case 'name' : 
                    $requested_data['name'] = $value;
                    break;

                case 'scope' :{
                        $scope = CompetitionScope::where('name', $value)->first();
                        $requested_data['comp_scope_id'] = $scope->id;
                    }
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

        $competition->update($requested_data);
        
        return $competition;
        
    }
}
