<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSeasonRequest extends FormRequest
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
            'name' => 'required|min:2|max:25',
            'competition_id' => 'required|numeric|unique:seasons,name|unique:seasons,comp_id',
            'is_active_season' => 'required|boolean'
        ];
    }
}
