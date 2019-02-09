@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="session-playlist col-md-3 px-0 collapsed d-sm-none">
        <div class="arrow-open text-gold text-center p-3 px-md-1 py-md-2 pointer">
            <i class="fas fa-arrow-right"></i>
        </div>

        @if($relatedVideos)
        <ul class="timeline">
                <span class="arrow-collapse pointer">
                    <i class="fas fa-arrow-alt-circle-left"></i>
                </span> 
            @foreach ($relatedVideos as $video)
            <li class="row py-2">
                <a class="col-md-8 text-gold" href="#"> {{ $video->title }} </a>
                <small class="col-md-4 duration text-right px-0"> {{ $video->duration() }}</small>
                
            </li>
            @endforeach
            
        </ul>

        {{-- <ul class="list-group w-100">
            <span class="arrow-collapse pointer">
                <i class="fas fa-arrow-alt-circle-left"></i>
            </span> 
            @foreach ($relatedVideos as $video)
            <li class="list-item px-3" id="{{$video->id}}">
                @if(Auth::check() === false || Auth::user()->canWatch($video) === false )
                <i class="fas fa-lock mr-2 text-danger"></i> @else
                <i class="fas fa-unlock mr-2 text-success"></i> @endif
                <a class="title" href="#"> {{ $video->title }} </a>
                <span class="duration ml-auto"> {{ $video->duration() }} </span>
            </li>
            @endforeach
        </ul> --}}
        @endif
    </div>


    <div class="poster col-md px-0">
        <div class="session-poster w-100" style="height:600px;">
            <div class="session-play-overlay p-4 text-center">
                <span class="mx-auto text-gold pointer" style="font-size:10em;vertical-align: middle;">
                    <i class="fas fa-play-circle" style="margin-top:100px;"></i>
                </span>
            </div>

            <div class="session-title-overlay p-4">
                <h3 class="text-gold mb-1">{{ $video->title }}</h3>
                <small class="text-white">
                    {{$course->name}} | 
                    {{ $course->level->name }} | 
                    {{ $course->school ? $course->school . ' | ' : '' }} 
                    {{ $course->system ? $course->system . ' | ' : '' }} 
                    {{ $course->sub_system ? $course->sub_system . ' | ' : '' }} 
                    {{ $video->duration() }}
                </small>
            </div>
        </div>
    </div>

</div>


<div class="row bg-gray p-2 mb-5 d-none d-sm-block">
    <div class="col-sm-12 mb-3">
        <h5 class="text-gold mb-2">Related sessions</h5>
    </div>
    <div class="col-sm-12 row justify-content-around">
        <div class="col-md-3" style="height:200px;">
            <div class="card bg-dark mb-2 w-100" style="height:80%;">Image goes here</div>
            <p class="text-center" style="height:20%;">Title goes here</p>
        </div>

        <div class="col-md-3" style="height:200px;">
            <div class="card bg-dark mb-2 w-100" style="height:80%;">Image goes here</div>
            <p class="text-center" style="height:20%;">Title goes here</p>
        </div>

        <div class="col-md-3" style="height:200px;">
            <div class="card bg-dark mb-2 w-100" style="height:80%;">Image goes here</div>
            <p class="text-center" style="height:20%;">Title goes here</p>
        </div>

        <div class="col-md-3" style="height:200px;">
            <div class="card bg-dark mb-2 w-100" style="height:80%;">Image goes here</div>
            <p class="text-center" style="height:20%;">Title goes here</p>
        </div>




    </div>


</div>

<div class="container">

    <div class="row justify-content-between my-5">
        <div class="col-md-7 bg-gray p-4">
            <h5 class="text-gold mb-2">Session Description</h5>
            <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem
                ipsum Lorem ipsum Lorem ipsum
            </p>
        </div>
        <div class="col-md-4 bg-gray p-4">
            <h5 class="text-gold mb-2">Session Details</h5>
            <p>Instructor: Hossam</p>
            <p>Course: Math</p>
            <p>Grade: 8th grade</p>
            <p>School: SAT</p>
            <p>Price: 120 EGP</p>
        </div>
    </div>

</div>
<div class="row bg-gray p-4 mb-5">
    <div class="col-sm-12">
        <h5 class="text-gold mb-2">Questions & Answers</h5>
    </div>
    <div class="col-sm-12">
        <p>Finished the session?<br/>You can test your understanding by taking a quiz.</p>
        <div>
            <img src="{{ asset_path('images/quiz4.png') }}" alt="">
            <button class="btn btn-gold">Start Quiz</button>
        </div>

    </div>


</div>
@endsection


 @push('css')
    <link rel="stylesheet" href="{{ asset_path('css/videos/show.css') }}">
    <link rel="stylesheet" href="{{ asset_path('css/courses/show.css') }}"> 
@endpush 

@push('scripts')
<script>
    $('.arrow-collapse').click(function(){
        $('.session-playlist').toggleClass('collapsed')
    })
    $('.arrow-open').click(function(){
        $('.session-playlist').toggleClass('collapsed')
    })

</script>


@endpush