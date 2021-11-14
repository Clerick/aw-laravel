@component('mail::message')
# {{ __('Hello, your request has been received') }}


@component('mail::panel')
{{ __('Your ticket uid:') . ' ' . $ticket->uid }}
@endcomponent

Thanks, {{ config('app.name') }}
@endcomponent