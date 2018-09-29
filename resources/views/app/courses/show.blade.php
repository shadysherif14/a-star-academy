@extends('layouts.app') 

@section('content')

<main class="showCourse">
    <div class="courseImage w-100 position-relative">
        <div class="overlay w-100 h-100 position-absolute"></div>
        <div class="row px-5 w-100 h-100 position-absolute" style="top:0;left:0;">

            <div class="col-md-6 row align-items-center">

                <p class="text-gold courseTitle mx-auto"> {{ $course->name }} </p>

            </div>

            <div class="col-md-6 d-flex flex-column justify-content-center">
                <div><p>{{ $course->description }}</p></div>
                <div class="text-center"><button class="btn btn-gold">Enroll</button></div>
            </div>
        </div>
    </div>





    <div class="container d-flex my-5">


        <div class="col-9">
            <div class="row video-wrapper mr-auto">
                <div class="col-12 h-100">
                    <video id="videoPlayer" class="video-fluid plyr mx-auto" controls playsinline>
                                        <source src="{{ asset('videos/video.mp4') }}" type="video/mp4" />
                                    </video>
                </div>
            </div>

            @if($intro)
                <h3 class="text-gold mt-5 mb-2">{{ $intro->title}}</h3>
                <div class="mb-5 w-100">
                    {{$intro->description}}
                </div>
            @endif

            @if($instructor)
            <div class="instructor p-3 my-5 position-relative">
                <span class="tag">Instructor</span>
                <div class="row align-items-center">
                    <div class="col-1 bg-white" style="border-radius: 50%;">
                        <img src=" {{$instructor->avatar}}" alt="" style="width:100%;height:auto;border-radius: 50%;">
                    </div>
                    <div class="col-10">
                        <p class="text-gold pl-3 m-0">{{$instructor->name}}</p>
                    </div>
                </div>
                <div class="my-4">
                    <p> {{$instructor->about}}</p>
                </div>
                
            </div>
            @endif
        </div>

        <div class="col-3">
            @if($videos)
                <ul class="list-group w-100">
                    {{-- Intro video --}}
                    <li class="list-item px-3 active">
                        <a href="#"> {{ $intro->title }} </a>
                        <span class="duration ml-auto"> {{ $intro->duration() }} </span>
                    </li>
                
                    @foreach ($videos as $video)
                    <li class="list-item px-3" id="{{$video->id}}">
                        @if(Auth::check() === false || Auth::user()->canWatch($video) === false )
                            <i class="fas fa-lock mr-2 text-danger"></i>
                        @else
                            <i class="fas fa-unlock mr-2 text-success"></i>

                        @endif
                            <a href="#"> {{ $video->title }} </a>
                            <span class="duration ml-auto"> {{ $video->duration() }} </span>
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>

        


    </div>

</main>

@stop 
@push('css')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.4.3/plyr.css">
    <link rel="stylesheet" href="{{ asset('css/courses/show.css') }}"> 

@endpush

@push('scripts')
    <script src="https://cdn.plyr.io/3.4.3/plyr.polyfilled.js"></script>
    <script src="{{asset('js/courses/show.js')}}"></script>

@endpush