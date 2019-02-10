@extends('layouts.app') 

@section('content')

<div class="row position-relative" style="min-height:70vh;">

    <!-- Overlay layer -->
    <div class="w-100 h-100 position-absolute bg-overlay" style="top:0;left:0;right:0;bottom:0;"> </div>

    <div class="w-100 h-100 p-5 p-sm-2">

        <div class="col-sm-12 row flex-row-reverse courseHeader">

            <div class="col-md-4 course-logo">
                <div class="w-75 mx-auto text-white">
                    <img src="{{ asset_path('images/courses/math.png') }}" class="img-fluid rounded-circle" alt="">
                </div>
            </div>

            <div class="course-info col-md-8 px-3 px-sm-0">
                <h2 class="text-gold">{{ $course->name}}</h2>
                <p class="text-white">"{{ $course->description }}"</p>
                <div class="mt-5 text-center-sm">
                    <button class="btn btn-gold mr-2">Enroll</button>
                    <button class="btn btn-gold mx-2">Add to watchlist</button>
                    <button class="btn btn-gold mx-2">Ay 7aga</button>
                </div>
            </div>

            <div class="row mb-5" style="border-bottom:1px solid #191919;line-height:4em;">
                <div class="container">
                    <div class="row">
                        <div class="px-0 col-sm-8 col-xs-8 text-left">By: {{ $instructor->name }}</div>
                        <div class="px-0 col-sm-4 col-xs-4 text-right">
                            <span class="mx-2" style="font-size:1.5em;vertical-align: middle;">
                                    <i class="fas fa-play-circle"></i>
                            </span>
                            <span style="vertical-align: middle;"> 
                                {{ count($videos) > 1 ? count($videos) . ' sessions' : count($videos) . ' session' }} 
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="session-list-wrapper w-100">
                <h1 class="title">Course Sessions</h1>
                <div class="text-center">
                    <small class="pointer mx-3" onclick="showAs('list')">Show as list</small>
                    <small class="pointer mx-3" onclick="showAs('slider')">Show as slider</small>
                </div>

                <div id="list" class="container my-5 px-5" style="display:none;">

                    <ul class="vertical-timeline">
                        @foreach($videos as $video)
                        <li class="row py-2">
                            <div class="col-md-8">
                                <a class="text-gold" href="/videos/{{$video->slug}}"> {{ $video->title }} </a>
                                <small class="d-block text-white">{{ $video->description }}</small>
                            </div>
                            <small class="col-md-4 duration text-right px-0"> {{ $video->duration }} </small>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div id="slider" class="timeline">
                    <div class="timeline-wrapper">
                        <div class="timeline-slider">
                            @foreach($videos as $video)
                            <div class="timeline-slide" data-year="1985"
                            style="background-image: url(https://unsplash.it/1920/600?image=11;">
                                <span class="timeline-year">{{ $video->price}} EGP </span>
                                <div class="timeline-slide__content">
                                    <h4 class="timeline-title">{{ $video->title }}</h4>
                                    <p class="timeline-text">{{ $video->description }}</p>
                                    <div>
                                        <button class="btn btn-gold float-right">Watch</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                
            </div>

            <div class="container d-flex my-5">

                <div class="col-9">
                    <div class="row video-wrapper mr-auto">
                        <div class="col-12 h-100">
                            <video id="videoPlayer" class="video-fluid plyr mx-auto" controls playsinline>
                                <source src="" type="video/mp4" />
                            </video>
                        </div>
                    </div>

                    @if($intro)
                    <h3 class="text-gold mt-5 mb-2">{{ $intro->title}}</h3>
                    <div class="mb-5 w-100">
                        {{$intro->description}}
                    </div>
                    @endif @if($instructor)
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
                            <span class="duration ml-auto"> {{ $intro->duration }} </span>
                        </li>

                        @foreach ($videos as $video)
                        <li class="list-item px-3" id="{{$video->id}}">
                            @if(Auth::check() === false || Auth::user()->canWatch($video) === false )
                            <i class="fas fa-lock mr-2 text-danger"></i>
                            @else
                            <i class="fas fa-unlock mr-2 text-success"></i> 
                            @endif
                            <a href="#"> {{ $video->title }} </a>
                            <span class="duration ml-auto"> {{ $video->duration }} </span>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>

            </div>

        </div>

    </div>

</div>

            
@stop 

@push('css')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.4.3/plyr.css">
    <link rel="stylesheet" href="{{ asset_path('slick/slick.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset_path('slick/slick-theme.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset_path('css/courses/show.css') }}" type="text/css" />
@endpush 

@push('scripts')
    <script src="https://cdn.plyr.io/3.4.3/plyr.polyfilled.js"></script>
    <script src="{{ asset_path('slick/slick.min.js') }}"></script>
    <script src="{{ asset_path('js/courses/show.js') }}"></script>
@endpush