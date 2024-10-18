{{-- blade-formatter-disable --}}
@component('mail::message')

Dear {{ $user->full_name }},

@if($user->is_activated == false)
Unfortunatetly there are circumstances that you did not totally comply and the {{ config('app.name') }} chooses to deactivate your account.
@endif

@if($user->is_activated == true)
Your account is now activated. You can now use our platform just click the button below to redirect.
@endif

@component('mail::button', ['url' => $url])
Redirect
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
