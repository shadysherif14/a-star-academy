@extends('admin.layouts.create') 
@section('form')

<form action="{{ $video->adminRoutes->update }}" method="post" class="ajax" enctype="multipart/form-data">

    @csrf

    <div class="card">
        <div class="header">
            <h2> <strong> Session information </strong> </h2>
        </div>

        <div class="body">
            
            @if($video->isOverview())
            <div class="alert bg-primary">
                This session is an overview session
            </div>
            @endif
            <input type="hidden" name="duration" id="duration" value="{{ $video->duration }}">
            <div class="form-group">
                <label for=""> Title </label>
                <input class="form-control" type="text" name="title" value="{{ $video->title }}">
            </div>
        
            @if(!$video->isOverview())
            <div class="price">
                <label>
                    <i class="fas fa-money-bill"></i>
                    <span> price </span>
                </label>
                <div class="row">
                    
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                            <i class="fas fa-infinity"></i>
                        </span>
                        <input type="text" value="{{ $video->unlimited_price }}" name="unlimited_price" class="form-control price" placeholder="Unlimted acces">
                    </div>

                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                            <i class="zmdi zmdi-collection-item-1"></i>
                        </span>
                        <input type="text" value="{{ $video->one_price }}" name="one_price" class="form-control price" placeholder="One time access">
                    </div>

                </div>                
            </div>
            @else
                <input type="hidden" name="overview" value="1">
            @endif
        
            <div class="form-group">
                <label> Description </label>
                <textarea class="form-control description" name="description" placeholder="Description">{{ $video->description }}</textarea>
            </div>
        
            <img src="{{ $video->frame }}" />
        
        </div>
    
    </div>

    <div class="card">
        <div class="header">
            <h2><strong> Session video </strong></h2>
        </div>
        <div class="body row clearfix">
    
            <div class="col-md-6">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <span class="btn bg-primary btn-file">
                    <span class=""> Change session </span>
                    <input type="file" id="video" name="video" accept="video/*"> </span>
                </div>

                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                    <video controls id="session-video" poster="{{ $video->poster }}">
                        <source class="embed-responsive-item" src="{{ $video->path }}" type="video/mp4">
                    </video>
                </div>
            </div>
    
            <div class="col-md-6">
                <div id="poster-wrapper">
                    <button type="button" class="btn bg-primary" id="poster-btn"> Capture a poster </button>
                    <img class="mt-2 img-fluid img-thumbnail" src="{{ $video->poster }}" alt="">
                </div>
            </div>
    
        </div>
    </div>
    @include('admin.partials.edit-button')

</form>

<form method="POST" id="poster-form" action="{{ action('Admin\PosterController@update', $video) }}">
    @csrf 
    @method('PUT')
    <input type="hidden" name="poster">
</form>

<video class="d-none" id="video"></video>

@endsection

@push('scripts')

    <script src="{{ secure_asset('js/admin/videos/create-edit.js') }}"></script>
    <script src="{{ secure_asset('js/admin/videos/edit.js') }}"></script>

@endpush