@component('mail::message')
# Hello {{$user->name}}

You changed your email address. Click button below to verify your account

@component('mail::button', ['url' => route('verify', $user->verification_token)])
Click to verify account
@endcomponent

Thanks, <br>
{{ config('app.name')}}
@endcomponent
