<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeopleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->id();
        return $user == 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:200',
            'height' => 'integer',
            'mass' => 'integer',
            'hair_color' => 'string|min:3|max:200',
            'birth_year' => 'string|min:3|max:200',
            'created' => 'date_format:Y-m-d',
            'gender_id' => 'required|integer|exists:genders,id',
            'homeworld_id' => 'required|integer|exists:homeworlds,id',
        ];
    }
}
