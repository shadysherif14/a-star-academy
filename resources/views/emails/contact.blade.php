@component('mail::message') 
# Hello {{ config('app.name') }} 
New message alert!
@component('mail::table') 
|    Name     |    Email     |
| :---------: | :----------: |
| {{ $name }} | {{ $email }} |
@endcomponent
<p style="border-left: 10px solid #e9e9e9;padding: 15px;background: #f6f8fa;margin: 30px auto;">{{ $body }} </p>
@endcomponent