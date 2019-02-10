@component('mail::message')

# Hello {{ $name }}

<h3> You have a new subscription </h3>

@component('mail::table')
| Student Name       | Session Name         | Course Name          | Price |
| :------------------: |:--------------------:|:--------------------:|:--------------------:|
|  {{ $user->name }}  | {{ $video->title }}  |{{ $video->course->name }}   | {{ $price }} EGP |
@endcomponent

@endcomponent
