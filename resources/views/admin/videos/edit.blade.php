@extends('admin.layouts.create') 

@section('form')

<form action="{{ $video->adminRoutes->update }}" method="post" class="ajax" enctype="multipart/form-data">

    @csrf

    <div class="card">
        <div class="header">
            <h2> <strong> Edit </strong> Session </h2>
        </div>

        <div class="row clearfix">

            <div class="col-md-6">
                <div class="body">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <span class="btn btn-primary btn-file">
                        <span class=""> Change session </span>
                        <input type="file" id="video" name="video" accept="video/*"> </span>
                    </div>

                    <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                        <video controls="" id="session-video">
                            <source class="embed-responsive-item" src="{{ $video->path }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="body">
                    
                    <input type="hidden" name="duration" id="duration" value="{{ $video->duration }}">
                    <div class="form-group">
                        <label for=""> Title </label>
                        <input class="form-control" type="text" name="title" value="{{ $video->title }}">
                    </div>

                    <div class="form-group">
                        <label> Price </label>
                        <input type="number" placeholder="Price" name="price" class="form-control" value="{{ $video->price }}">
                    </div>
                    
                    <div class="form-group">
                        <label> Description </label>
                        <textarea class="form-control description" name="description" placeholder="Description">{{ $video->description }}</textarea>
                    </div>

                <img src="{{ $video->frame }}" />
        
                </div>
            </div>

        </div>

    </div>

    @include('admin.partials.edit-button')

</form>

<div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
    <video controls="" id="video">
        <source class="embed-responsive-item" src="{{ $video->path }}" type="video/mp4">
    </video>
</div>
{{--  <video class="" id="video">
    <source class="embed-responsive-item" src="{{ $video->path }}" type="video/mp4">
</video>  --}}
<img id="my-screenshot" />

@endsection
 
@push('scripts')
    <script src="{{ asset('js/admin/videos/create-edit.js') }}"></script>
    <script src="{{ asset('js/admin/videos/edit.js') }}"></script>
@endpush 
