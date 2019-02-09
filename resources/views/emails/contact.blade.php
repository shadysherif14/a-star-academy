@component('mail::message') # Hello {{ config('app.name') }} @component('mail::table') | Name | Email | | :------------------:
|:--------------------:| | {{ $name }} | {{ $email }} | @endcomponent
<p>{{ $body }}</p>

@endcomponent