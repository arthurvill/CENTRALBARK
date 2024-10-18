<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
                'service_category_id' => ['required'],
                'name' => ['required', \Illuminate\Validation\Rule::unique('services', 'name')],
                'description' => ['required'],
                'fee' => ['required'],
            ],
            'PUT' => [
                'service_category_id' => ['required'],
                'name' => ['required',  \Illuminate\Validation\Rule::unique('services')->ignore($this->service)],
                'description' => ['required'],
                'fee' => ['required'],
            ]
        };
    }

    public function messages()
    {
        return [
            'service_category_id.required' => 'The service category field is required',
            'name.required' => 'The service field is required',
            'name.unique' => 'Service has already been exist',
        ];
    }
}