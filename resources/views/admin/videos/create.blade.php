@extends('admin.layouts.create') 

@section('form')

<form action="{{ $course->videosRoute('store') }}" id="form" method="POST" class="ajax" enctype="multipart/form-data">

    @csrf

    <div class="card">

        <div class="header">
            <h2> <strong> <i class="fas fa-video"></i> New </strong> Sessions </h2>
        </div>

        <div class="body">

            <p class="mb-5"> {{ $course->name }} sessions are stored in <strong class="text-warning"> public/storage/{{ $course->videos_path }} </span>    </p>

            <div class="col-md-10 mx-auto videos">
                
                <input type="hidden" name="duration" id="video-duration">
                <input type="hidden" name="poster" id="video-poster">
                <div class="form-group">
                    <label> Title </label>
                    <input type="text" name="title" placeholder="Title" class="form-control title">
                </div>

                <div class="form-group">
                    <label for="video"> Video </label>
                    <select id="videos-list" name="video" title="Video" class="form-control">
                    @foreach($videos as $video)
                        <option value="{{ $video }}"> {{ $video }} </option>
                    @endforeach
                    </select>
                </div>

                <video class="d-none" id="video"></video>
    
                <div class="form-group">
                    <label> Price </label>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa-infinity"></i>
                                </span>
                                <input type="text" id="max-times" name="max_times" class="form-control price unlimited" placeholder="Maximum times of access">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa-infinity"></i>
                                </span>
                                <input type="text" id="max-price" name="max_price" class="form-control price unlimited" placeholder="Maximum times of access price">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="zmdi zmdi-collection-item-1"></i>
                                </span>
                                <input type="text" name="one_price" class="form-control price one" placeholder="One time access price">
                            </div>
                        </div>
    
                    </div>
                </div>
    
                <div class="form-group">
                    <label> Description </label>
                    <textarea class="form-control description"  name="description" placeholder="Description"></textarea>
                </div>
                
    
                <div class="row justify-content-center buttons">
    
                    <button type="submit" class="btn bg-primary">
                        <i class="zmdi zmdi-upload"></i> 
                        Upload
                    </button>
    
                </div>
            </div>

        </div>
    </div>


</form>

@stop 

@push('scripts')
    <script src="{{ asset_path('assets/plugins/waitMe/waitMe.js') }}"></script>
    <script>let path = @json(asset("storage/{$course->videosPath}"))</script>
    <script src="{{ asset_path('js/admin/videos/create.js') }}"></script>
@endpush