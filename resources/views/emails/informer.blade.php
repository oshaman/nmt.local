@component('mail::panel')
    {!! $content ?? '' !!}
@endcomponent

@component('mail::footer')
    © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
@endcomponent