@extends('layouts.admin') 

@section('title', '| Videos') 

@section('content')

<a class="btn create" href="{{ route('admin.videos.create', ['course' => $course] ) }}">
    <i class="fas fa-plus"></i> Add More Videos
</a>

@php
    if(count($videos) === 0) 
        $hidden = 'd-none';
    else   
        $hidden = '';
@endphp

@includeWhen( count($videos) == 0, 'includes.no_records', ['record' => 'video'])


<form class="card ajax" action="{{ route('admin.videos.order') }}" method="POST">

    @csrf

    @method('put')

    <div class="card-header grid {{ $hidden }}">
        <div> Title </div>
        <div> Free </div>
        <div> Quiz </div>
        <div> </div>
        <div> </div>
    </div>

    <div class="card-body" id="videos">

        @foreach($videos as $video)

        <div class="grid" id="video-{{ $video->id }}" video="{{ $video->path }}">

            <div>
                <input type="hidden" name="videos[{{ $loop->iteration }}][id]" value="{{ $video->id }}">
                <p class="link modal-trigger">
                    <a class=""> {{ $video->title }} </a>
                </p>
            </div>

            <div class="switch">

                <div>
                    <p class="content"> Free </p>
                </div>
                <label>
                    Paid
                    <input type="checkbox" name="videos[{{ $loop->iteration }}][free]" @if($video->free) checked @endif>
                    <span class="lever"></span>
                    Free
                </label>
            </div>

            <div>
                <div>
                    <p class="content">
                        Quiz
                    </p>
                </div>
                <a href="{{ route('admin.quizzes.index', ['video' => $video]) }}" class="">
                    Quiz
                </a>
            </div>
            <div>
                <div>
                    <p class="content"> Actions </p>
                </div>
                <div class="actions">
                    <button type="button" class="btn btn-floating show modal-trigger">
                        <i class="fas fa-eye"> </i>
                    </button>
                    <a type="button" class="btn btn-floating edit" href="{{ route('admin.videos.edit', ['video' => $video]) }}">
                        <i class="fas fa-pen"> </i>
                    </a>
                    <button type="button" class="btn btn-floating delete" action="{{ route('admin.videos.destroy', ['video' => $video]) }}">
                        <i class="fas fa-trash"> </i>
                    </button>
                </div>
            </div>

            <div class="icons d-none d-lg-block">
                <i class="fas fa-sort handler"></i>
            </div>

        </div>

        @endforeach

    </div>

    <button class="btn btn-submit {{ $hidden }}" type="submit">
        <i class="fas fa-pen"> Update </i>
    </button>

</form>

<div class="modal fade" id="video-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

            <!--Body-->
            <div class="modal-body mb-0 p-0">

                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                    <iframe class="embed-responsive-item" src="" allowfullscreen></iframe>
                </div>

            </div>

        </div>

    </div>
</div>

@endsection
 
@section('scripts')
    <script src="{{ asset('js/videos/index.js') }}"></script>
@endsection
 
@section('css')
    <link rel="stylesheet" href="{{ asset('css/videos/index.css') }}">
@endsection