{{-- blade-formatter-disable --}}
@component('mail::message')

Dear {{ $booking->pet->customer->full_name }},

Good day, we would like to inform you that we have already set you an appointment.<br>
@component('mail::panel')
Appointment Schedule <br>
Service: {{ $booking->schedule->service->name}} <br>
Patient/Pet: {{ $booking->pet->name }} <br>
Owner: {{ $booking->pet->customer->full_name }} <br>
Date: {{formatDate($booking->schedule->date_time_start) }} at {{formatDate($booking->schedule->date_time_start, 'time') }} - {{formatDate($booking->schedule->date_time_end, 'time') }} <br>
Clinic: Central Bark Veterinary Clinic located at Tungkop, Minglanilla, Cebu, Philippines <br>
Remark: {{$booking->remark ?? 'N/A'}} 
@endcomponent


@component('mail::button', ['url' => $url, 'color' => 'success'])
Redirect
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent



