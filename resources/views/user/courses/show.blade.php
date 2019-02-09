@extends('layouts.user') 
@section('content')

<div class="course">
    <section id="{{ $course->slug }}" class="body">
        <div class="details">

            <div class="title">
                <h4 class="name wow"> {{ $course->name }} </h4>
            </div>
            <section class="tags wow">
                <span filter="{{ $course->level->school }}" class="tag">{{ $course->level->school }}</span>
                <span filter="{{ $course->level->name }}" class="tag">{{ $course->level->name }}</span> @if($course->system)
                <span filter="{{ $course->system }}" class="tag">{{ $course->system }}</span> @endif @if($course->sub_system)
                <span filter="{{ $course->sub_system }}" class="tag">{{ $course->sub_system }}</span> @endif
            </section>
            <p class="description wow"> {{ $course->description }} </p>
            <div class="videos wow">
                <img src="{{ imageIcon('video') }}" alt="Video" class="icon">
                <strong> {{ $course->videosCount }} </strong>
            </div>

            <div class="instructor wow">
                <img class="img-raised" src="{{ $course->instructor->avatar }}" alt="Instructor Avatar">
                <div class="details">

                    <h5 class="name">
                        <a href="{{ action('User\InstructorController@show', $course->instructor) }}"> {{ $course->instructor->name }} </a>
                    </h5>
                    <p class="about"> {{ $course->instructor->about }} </p>
                </div>
            </div>

            <div class="buttons wow">
                @if($course->overview())
                <a class="btn" href="{{ action('User\VideoController@show', $course->overview()) }}"> Watch Free Preview </a>                @endif
            </div>

        </div>
        <div class="image-wrapper wow">
            <img src="{{ $course->image }}" alt="Course Image" class="img-resposnive rounded-circle img-raised">
        </div>
    </section>
</div>

@if(count($videos))

<div class="videos-header">
    <img src="{{ imageIcon('books') }}" alt="">
    <h1>
        {{ $course->name }} Sesssions
    </h1>
</div>

<section class="layouts">

    <p class="text"> View As: </p>

    <button type="button" class="btn btn-icon btn-icon-mini active" layout="slider" title="Slider">
        <i class="zmdi zmdi-view-carousel animated infinite swing"></i>
    </button>

    <button type="button" class="btn btn-icon btn-icon-mini" layout="grid" title="Grid">
        <i class="fas fa-grip-horizontal animated infinite swing"></i>
    </button>

    <button type="button" class="btn btn-icon btn-icon-mini " layout="flippers" title="Flip">
        <i class="fas fa-sync-alt animated infinite swing"></i>
    </button>

</section>

<div id="videos">

    <section id="videos-grid" class="layout">
        <div class="grid">
            @foreach ($videos as $video)
    @include('user.videos.grid', $video) @endforeach
        </div>

    </section>

    <section id="videos-slider" class="layout">

        <div class="top"></div>
        <div class="sliders">

            <button type="button" class="btn controls prev" control="prev" disabled>
                <i class="typcn typcn-chevron-left-outline animated infinite wobble"></i>
            </button>

            <div class="sessions">
                @foreach ($videos as $video)
    @include('user.videos.slider', compact('loop', 'video')) @endforeach
            </div>

            <button type="button" class="btn controls next" control="next">
                <i class="typcn typcn-chevron-right-outline animated infinite wobble"></i>
            </button>
        </div>

        <div class="navigation">
            @foreach ($videos as $video)
            <span class="nav {{ $loop->first ? 'active' : '' }}" data-tippy-content="<h5> {{ $video->title }} </h5> <img src='{{ $video->poster }}' />"
                slide="{{ $loop->index }}"></span> @endforeach
        </div>

    </section>

    <section id="videos-flippers" class="layout">
        @foreach($videos as $video)
    @include('user.videos.flipper', $video) @endforeach
    </section>

</div>

@endif 
@stop @push('css')
<link rel="stylesheet" href="{{ asset_path('css/user/courses/show.css') }}"> 
@endpush @push('scripts')
<script>
    let sessionsNumber = @json(count($videos));
</script>
<script src="{{ asset_path('js/user/courses/show.js') }}"></script>

@endpush