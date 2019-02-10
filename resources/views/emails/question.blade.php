@component('mail::message')
<!-- NEW LINE -->
# Hello {{ $instructorName }}

<!-- NEW LINE -->

#### New question from **_{{ $name }}_**
<!-- NEW LINE -->
- **Email:** **{{ $email }}**
<!-- NEW LINE -->
- **Session:** {{ $title }}</p>
<!-- NEW LINE -->
- **Date:** {{ \Carbon\Carbon::now()->setTimezone('Africa/Cairo')->toDayDateTimeString() }}</p>
<!-- NEW LINE -->

###**Question:**


<!-- NEW LINE -->
<p style="border-left: 10px solid #e9e9e9;padding: 15px;background: #f6f8fa;margin: 30px auto;">{{ $body }} </p>


Thanks,<br> {{ config('app.name') }}
<!-- NEW LINE -->
@endcomponent