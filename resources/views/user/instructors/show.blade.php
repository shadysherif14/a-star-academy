@extends('layouts.user') 

@section('content')

<div class="instructor-wrapper">
    <section id="{{ $instructor->username }}" class="body wow fadeInUp">
        <div class="details">

            <div class="title">
                <h4 class="name"> {{ $instructor->name }} </h4>
            </div>

            <p class="about"> {{ $instructor->about }} </p>

            <div class="meta">
                @if($instructor->email)
                <div class="email">
                    <img src="{{ imageIcon('email') }}" alt="email" class="icon">
                    <span> {{ $instructor->email }} </span>
                </div>
                @endif @if($instructor->phone)
                <div class="phone">
                    <img src="{{ imageIcon('phone') }}" alt="phone" class="icon">
                    <span> {{ $instructor->phone }} </span>
                </div>
                @endif

                <div class="courses">
                    <img src="{{ imageIcon('graduation') }}" alt="graduation" class="icon">
                    <span>{{ $instructor->coursesCount }}</strong>
                </div>
            </div>

            @if ($instructor->accounts)
            <div class="social">
                @foreach ($instructor->accounts as $name => $link)
                <a href="{{ $link }}" target="_blank" class="{{ $name }}">
                    <img src="{{ imageIcon($name) }}" alt="{{ $name }}" class="icon">
                </a>
                @endforeach
            </div>
            @endif
        </div>
        <div class="image-wrapper">
            <img src="{{ $instructor->avatar }}" alt="instructor Image" class="img-resposnive img-raised">
        </div>
    </section>
</div>

@if($instructor->courses()->count())
<div id="courses">

    <div class="header">
        <img src="{{ imageIcon('books') }}" alt="">
        <h1>
            {{ $instructor->name }} Courses
        </h1>
    </div>

    <section id="list">
        
        @foreach($instructor->courses as $course)
        <section id="{{ $course->slug }}" class="single wow fadeInUp">
            <div class="details">
                <div class="title">
                    <h3 class="name"> {{ $course->name }} </h3>
                </div>
                <section class="tags">
                    <span filter="{{ $course->level->school }}" class="tag">{{ $course->level->school }}</span>
                    <span filter="{{ $course->level->name }}" class="tag">{{ $course->level->name }}</span> @if($course->system)
                    <span filter="{{ $course->system }}" class="tag">{{ $course->system }}</span> @endif @if($course->sub_system)
                    <span filter="{{ $course->sub_system }}" class="tag">{{ $course->sub_system }}</span> @endif
                </section>
                <div class="instructor">
                    <img class="img-raised" src="{{ $course->instructor->avatar }}" alt="Instructor Avatar">
                    <p class="name"> {{ $course->instructor->name }} </p>
                </div>
                <p class="description"> {{ $course->description }} </p>
                <p class="meta"> {{ $course->videosCount }} </p>
    
                <div class="buttons-wrapper">
                    <div class="buttons">
                        <a class="btn" href="{{ action('User\CourseController@show', $course) }}"> Preview All Sessions </a>                    @if($course->overview())
                        <a class="btn" href="{{ action('User\VideoController@show', $course->overview()) }}"> Watch Free Preview </a>                    @endif
                    </div>
                </div>
            </div>
            <div class="image-wrapper">
                <img src="{{ $course->image }}" alt="Course Image" class="img-resposnive">
            </div>
        </section>
        @endforeach
    </section>
</div>
@endif

@stop


@push('css')
    <link rel="stylesheet" href="{{ asset_path('css/user/instructors/show.css') }}"> 
@endpush 

@push('scripts')
    <script src="{{ asset_path('js/user/instructors/show.js') }}"></script>
@endpush