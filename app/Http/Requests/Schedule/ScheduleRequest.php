<?php

namespace App\Http\Requests\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
        return match (request('type')) {
            'manual' => [
                'service_id' => ['required'],
                'date_time_start' => ['required', 'array'],
                'date_time_start.*' => ['required'],
                'date_time_end' => ['required', 'array'],
                'date_time_end.*' => ['required'],
            ],

            'bulk' => [
                'service_id' => ['required'],
                'day_type' => ['required', 'array'],
                'day_type.*' => ['required'],
                'time_start' => ['required', 'array'],
                'time_start.*' => ['required'],
                'time_end' => ['required', 'array'],
                'time_end.*' => ['required'],
            ]

        };
    }

    public function messages()
    {
        return [
            'service_id.required' => 'The service field is required.',
        ];
    }
}