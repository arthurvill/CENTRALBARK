{{-- blade-formatter-disable --}}
@component('mail::message')

Dear {{ $booking->pet->customer->full_name }},

@if ($booking->status == \App\Models\Booking::APPROVED)
Good day, your requested schedule has been moved.<br>
@component('mail::panel')
Appointment Schedule <br>
Service: {{ $booking->schedule->service->name}} <br>
Patient/Pet: {{ $booking->pet->name }} <br>
Owner: {{ $booking->pet->customer->full_name }} <br>
Previous Schedule: {{ formatDate($old_schedule->date_time_start) }} at
{{ formatDate($old_schedule->date_time_start, 'time') }} -
{{ formatDate($old_schedule->date_time_end, 'time') }}<br>
New Schedule: {{ formatDate($booking->schedule->date_time_start) }} at
{{ formatDate($booking->schedule->date_time_start, 'time') }} -
{{ formatDate($booking->schedule->date_time_end, 'time') }}<br>
Clinic: Central Bark Veterinary Clinic located at Tungkop, Minglanilla, Cebu, Philippines  <br>
Remark: {{ $booking->remark ?? 'N/A' }}
@endcomponent
@endif

@component('mail::button', ['url' => $url, 'color' => 'success'])
Redirect
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent




















