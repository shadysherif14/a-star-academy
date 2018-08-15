@extends('layouts.admin') 
@section('title', '| Videos') 
@section('content')

<form class="card ajax" action="{{ route('admin.videos.order') }}" method="POST">

    @csrf

    @method('put')

    <div class="card-header grid">
        <div> Title </div>
        <div> Free </div>
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
                <label>
                    Paid
                    <input type="checkbox" name="videos[{{ $loop->iteration }}][free]" @if($video->free) checked @endif>
                    <span class="lever"></span>
                    Free
                </label>
            </div>

            <div class="actions">
                <button type="button" class="btn show modal-trigger">
                    <i class="fas fa-eye"> Preview </i>
                </button>
                <a type="button" class="btn edit" href="{{ route('admin.videos.edit', ['video' => $video]) }}">
                    <i class="fas fa-pen"> Edit </i>
                </a>
                <button type="button" class="btn delete">
                    <i class="fas fa-trash"> Delete </i>
                </button>
            </div>

            <div class="icons">
                <i class="fas fa-sort handler"></i>
            </div>

        </div>

        @endforeach

    </div>

    <button class="btn btn-submit" type="submit">
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