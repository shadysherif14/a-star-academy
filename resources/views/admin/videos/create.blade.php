@extends('layouts.admin') 

@section('title', '| Courses - Create') 

@section('content')



<form action="{{ route('admin.videos.store', ['course' => $course]) }}" method="POST" class="card ajax" enctype="multipart/form-data">
    
    @csrf

    <div class="card-header">
        <h3> <i class="fas fa-video"> New Videos </i> </h3>
    </div>

    <div class="card-body">

        <div class="md-form">

            <div class="file-field">

                <a class="btn-floating elegant-color-dark mt-0 float-left">
                    <i class="fas fa-video" aria-hidden="true"></i> <input name="files[]" type="file" multiple>
                </a>

                <div class="file-path-wrapper">
                    <input class="file-path" type="text" placeholder="Upload a new video">
                </div>

            </div>

        </div>
    </div>

    <div class="card-header grid d-none">
        <div> Title </div>
        <div> Free </div>
        <div> </div>
    </div>


    <div class="card-body">

        <div id="videos"></div>
    
    </div>

    <button type="submit" class="btn btn-submit"> <i class="fas fa-upload"></i> Upload </button>

</form>
</div>





@stop 
@section('scripts')
<script src="{{ asset('js/videos/create.js') }}"></script>



@stop 
@section('css')
<link rel="stylesheet" href="{{ asset('css/videos/create.css') }}"> 
@stop