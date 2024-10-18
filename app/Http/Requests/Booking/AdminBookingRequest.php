<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class AdminBookingRequest extends FormRequest
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
            'pet_id' => ['required'],
            'schedule_id' => ['required'],
            'note' => ['sometimes'],
        ];
    }

    public function messages()
    {
        return [
            'pet_id.required' => 'The pet patient field is required',
            'schedule_id.required' => 'The schedule field is required',
        ];
    }
}