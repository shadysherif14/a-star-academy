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


<form class="card ajax" action="{{ route('admin.videos.order') }}" method="POST" id="videos-form">

    @csrf

    @method('put')

    <div class="card-header grid {{ $hidden }}">
        <div> Title </div>
        <div> Free </div>
        <div> Quiz </div>
        <div> </div>
        <div></div>
    </div>

    <div class="card-body" id="videos">

        @foreach($videos as $video)

        <div class="grid" id="video-{{ $video->id }}" video="{{ $video->path }}">

            <div>
                <input type="hidden" name="videos[{{ $loop->iteration }}][id]" value="{{ $video->id }}">
                
                <a class="btn btn-link modal-trigger text-lg-white"> {{ $video->title }} </a>
            </div>


            <div>

                <div>
                    <p class="content"> Pay  </p>
                </div>
                
                <button type="button" price={{ $video->price }} 
                        action="{{ route('admin.payables.show', ['payable' => $video]) }}" class="pay btn btn-link">                    
                    Pay {{ $video->price }} L.E
                </button>
            </div>

            <div>
                <div>
                    <p class="content">
                        Quiz
                    </p>
                </div>
                <a href="{{ route('admin.quizzes.index', ['video' => $video]) }}" class="btn btn-link">
                    Quiz
                </a>
                                
            </div>


            <div>
                <div>
                    <p class="content"> Actions </p>
                </div>
                <div class="actions">
                    <button type="button" class="btn show modal-trigger">
                        <i class="fas fa-eye"> </i>
                    </button>
                    <a type="button" class="btn edit" href="{{ route('admin.videos.edit', ['video' => $video]) }}">
                        <i class="fas fa-pen"> </i>
                    </a>
                    <button type="button" class="btn delete" action="{{ route('admin.videos.destroy', ['video' => $video]) }}">
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


@include('includes.payable_form')

@endsection
 
@section('scripts')
    <script src="{{ asset('js/admin/videos/index.js') }}"></script>
    <script src="{{ asset('js/admin/payables/index.js') }}"></script>
@endsection
 
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/videos/index.css') }}">
@endsection