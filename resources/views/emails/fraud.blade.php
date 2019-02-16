@component('mail::message')
# Hello {{ config('app.name') }}
<p style="color:red;font-weight:bold;">A FRAUD HAS BEEN DETECTED!!! </p>
<p style="color:red;font-weight:bold;">We notify you in order to look into it. The user has been blocked and below his/her information</p>
@component('mail::table')
|           School           |       Username        |       Email        |       Phone        |       Gender        |       Serial        |
| :------------------------: | :-------------------: | :----------------: | :----------------: | :-----------------: | :-----------------: |
| {{ $user->level->school }} | {{ $user->username }} | {{ $user->email }} | {{ $user->phone }} | {{ $user->gender }} | {{ $user->serial }} |
@endcomponent
@endcomponent