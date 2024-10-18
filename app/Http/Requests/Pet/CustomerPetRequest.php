<?php

namespace App\Http\Requests\Pet;

use Illuminate\Foundation\Http\FormRequest;

class CustomerPetRequest extends FormRequest
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
        return match ($this->method()) {
            'POST' => [
                'category_id' => ['required'],
                'name' => ['required'],
                'breed' => ['required'],
                'sex' => ['required'],
                'birth_date' => ['required'],
                'color' => ['required'],
                'weight' => ['required'],
            ],
            'PUT' => [
                'category_id' => ['required'],
                'name' => ['required'],
                'breed' => ['required'],
                'sex' => ['required'],
                'birth_date' => ['required'],
                'color' => ['required'],
                'weight' => ['required'],
            ]
        };
    }

    public function messages()
    {
        return [
            'category_id.required' => 'The category field is required',
            'name.required' => 'The pet name field is required',
        ];
    }
}