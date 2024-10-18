<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class CustomerBookingRequest extends FormRequest
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
            'service_id' => ['required'],
            'schedule_id' => ['required'],
            'reference_no' => ['required'],
            'image' => ['required'],
            'payment_method_id' => ['required'],
            'note' => ['sometimes'],
            'g-recaptcha-response' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'pet_id.required' => 'The pet field is required',
            'service_id.required' => 'The service field is required',
            'image.required' => 'The payment receipt field is required',
            'payment_method_id.required' => 'The payment method field is required',
            'g-recaptcha-response.required' => 'The captcha field is required.',
        ];
    }
}