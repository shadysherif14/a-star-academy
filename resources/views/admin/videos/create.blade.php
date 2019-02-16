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
                    <select id="videos-list" name="video" class="custom-select">
                        <option disabled selected> Video </option>
                    @foreach($videos as $video)
                        <option value="{{ $video }}"> {{ $video }} </option>
                    @endforeach
                    </select>
                </div>

                <video class="d-none" id="video"></video>
    
                <div>
                    <p class="m-0 text-black"> Max Times of Access </p>
                    <div class="row">
                        <div class="form-group mt-2 col-md-6">
                            <label for="">Times</label>
                            <input type="number" min="2" id="max-times" name="max_times" class="form-control price unlimited" placeholder="Times">
                        </div>

                        <div class="form-group mt-2 col-md-6">
                            <label for="">Price</label>
                            <input type="number" min="0" id="max-price" name="max_price" class="form-control price unlimited" placeholder="Price">
                        </div>
                    </div>
                </div>

                <div>
                    <p class="m-0 text-black"> One Time Access</p>
                    <div class="row">
                        <div class="form-group mt-2 col-md-6">
                            <label for="">Times</label>
                            <input type="number" min="1" class="form-control" value="1" placeholder="Times" readonly>
                        </div>
                        <div class="form-group mt-2 col-md-6">
                            <label for="">Price</label>
                            <input type="number" min="0" name="one_price" class="form-control" placeholder="Price">
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