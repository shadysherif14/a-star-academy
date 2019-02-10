@extends('layouts.user') 
@section('content')
<header id="header">

    <div class="content">
        <div class="image d-md-none d-block">
            <img src="{{ asset_path('images/header.png') }}" alt="">
        </div>

        <div class="text">
            <h2 class="font-italic">Learn Today, Lead Tomorrow</h2>
        </div>

        <div class="image d-md-block d-none">
            <img src="{{ asset_path('images/header.png') }}" alt="">
        </div>
    </div>
</header>

<header id="slider">
    <div class="slide" slide="1" id="slide-1"></div>
    <div class="slide" slide="2" id="slide-2"></div>
    <div class="slide" slide="3" id="slide-3"></div>
    <div class="slide" slide="4" id="slide-4"></div>
</header>

<section class="skills">
    <h3> The most concise screencasts for the brilliant student. </h3>
    <div class="stats">

        <div class="hours">
            <h5 class="count-to" data-from="0" data-to="{{ $hours }}" data-speed="4000" data-fresh-interval="700">
                {{ $hours }}
            </h5>
            <p> Hours of Learning </p>
        </div>

        <div class="courses">
            <h5 class="count-to" data-from="0" data-to="{{ $courses }}" data-speed="4000" data-fresh-interval="700">
                {{ $courses }}
            </h5>
            <p> Courses </p>
        </div>
    </div>
</section>

<section class="schools">
    @foreach ($schools as $school)
    <div class="school" id="{{ $school->name }}">

        <h4 class="name"> {{ $school->name }} </h4>

        <div class="school-stats">
            <div>
                <h5 class="count-to" data-from="0" data-to="{{ $school->courses }}" data-speed="4000" data-fresh-interval="700">
                    {{ $school->courses }}
                </h5>
                <p> Courses </p>
            </div>
            <div>
                <h5 class="count-to" data-from="0" data-to="{{ $school->videos }}" data-speed="4000" data-fresh-interval="700">
                    {{ $school->videos }}
                </h5>
                <p> Videos </p>
            </div>
        </div>
    </div>
    @endforeach
</section>
@endsection
 @push('css')
<link rel="stylesheet" href="{{ asset_path('css/user/home.css') }}"> 
@endpush @push('scripts') 
@endpush