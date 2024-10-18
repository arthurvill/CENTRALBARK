<?php

namespace App\Http\Requests\ServiceCategory;

use Illuminate\Foundation\Http\FormRequest;

class ServiceCategoryRequest extends FormRequest
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

    public function rules()
    {
        return match ($this->method()) {
            'POST' => [
                'name' => ['required', 'unique:service_categories,name'],
            ],
            'PUT' => [
                'name' => ['required', \Illuminate\Validation\Rule::unique('service_categories')->ignore($this->service_category)],
            ]
        };

    }

    public function messages()
    {
        return [
            'name.unique' => 'The service category has already been exist'
        ];
    }
}