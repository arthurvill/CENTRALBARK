<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        return [
            'first_name' => ['required'],
            'middle_name' => ['sometimes'],
            'last_name' => ['required'],
            'sex' => ['required'],
            'birth_date' => ['required'],
            'address' => ['required'],
            'contact' => ['required'],
            'contact' => ['required', 'digits:11'],
            'email' => ['required','email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8', 'max:12'],
            'terms_of_service' => ['accepted']
       ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'The email address has already been taken',
        ];
    }
}