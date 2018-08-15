@extends('layouts.admin') 
@section('title', '| Videos - Edit') 
@section('content')


<form action="{{ route('admin.videos.update', ['video' => $video]) }}" method="post" class="card ajax" enctype="multipart/form-data">

    @csrf @method('put')

    <div class="card-header">

        <h4> <i class="fas fa-video"></i> Edit Video </h4>

    </div>

    <div class="card-body">

        <div class="md-form">

            <div class="file-field">

                <a class="btn-floating elegant-color-dark mt-0 float-left">
                    <i class="fas fa-video" aria-hidden="true"></i> <input name="video" type="file">
                </a>

                <div class="file-path-wrapper">
                    <input class="file-path" type="text" placeholder="Upload a new video">
                </div>

            </div>

        </div>

        <div class="md-form my-5">
            <input class="form-control" type="text" name="title" value="{{ $video->title }}">
            <label for=""> Title </label>
        </div>

        <h3> Free Video? </h3>
        <div class="switch mb-4">
            <label>
                Paid
                <input type="checkbox" name="free" @if($video->free) checked @endif>
                <span class="lever"></span>
                Free
            </label>
        </div>

        <h3> Video Changed? </h3>
        <div class="switch">
            <label>
                No
                <input type="checkbox" name="path_changed">
                <span class="lever"></span>
                Yes
            </label>
        </div>

        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half my-5">
            <iframe class="embed-responsive-item" src="{{ $video->path }}" autoplay  allowfullscreen></iframe>
        </div>
    </div>

    <button type="submit" class="btn btn-submit"> <i class="fas fa-pen"></i> Edit </button>

</form>
@endsection
 
@section('scripts')
    <script src="{{ asset('js/videos/edit.js') }}"></script>
@stop 

@section('css')
<link rel="stylesheet" href="{{ asset('css/courses/create.css') }}"> 
@stop