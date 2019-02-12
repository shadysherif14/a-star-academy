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
            <input type="hidden" name="duration" id="video-duration">
            <input type="hidden" name="poster" id="video-poster">

            <div class="form-group">
                <label for=""> Title </label>
                <input class="form-control" type="text" name="title" value="{{ $video->title }}">
            </div>

            @if(!$video->isOverview())
            <div class="price">

                <div>
                    <p class="m-0"> Max Times of Access </p>
                    <div class="row">
                        <div class="form-group mt-2 col-md-6">
                            <label for="">Times</label>
                            <input type="number" min="2" id="max-times" name="max_times" class="form-control" placeholder="Times" value="{{ $video->max_times }}">
                        </div>
                
                        <div class="form-group mt-2 col-md-6">
                            <label for="">Price</label>
                            <input type="number" min="0" id="max-price" name="max_price" class="form-control" placeholder="Price" value="{{ $video->max_price }}">
                        </div>
                    </div>
                </div>
                
                <div>
                    <p class="m-0"> One Time Access</p>
                    <div class="row">
                        <div class="form-group mt-2 col-md-6">
                            <label for="">Times</label>
                            <input type="number" min="1" class="form-control" value="1" placeholder="Times" readonly>
                        </div>
                        <div class="form-group mt-2 col-md-6">
                            <label for="">Price</label>
                            <input type="number" min="0" name="one_price" class="form-control" 
                            placeholder="Price" value="{{ $video->one_price }}">
                        </div>
                    </div>
                </div>
                
            </div>
            @else
            <input type="hidden" name="overview" value="1"> @endif

            <div class="form-group">
                <label> Description </label>
                <textarea class="form-control description" name="description" placeholder="Description">{{ $video->description }}</textarea>
            </div>

        </div>

    </div>

    <div class="card">
        <div class="header">
            <h2><strong> Session video </strong></h2>
        </div>
        <div class="body row clearfix">

            <div class="col-md-6">

                <div class="form-group">
                    <label for="video"> Video </label>
                    <select id="videos-list" name="video" title="Video" class="form-control">
                    @foreach($videos as $videoPath)
                        <option value="{{ $videoPath }}"> {{ $videoPath }} </option>
                    @endforeach
                    </select>
                </div>

                <video poster="{{ $video->poster }}" src="{{ $video->path }}" id="video"></video>
            </div>

            <div class="col-md-6 mt-5">
                <div id="poster-wrapper">
                    <button type="button" class="btn bg-primary" id="poster-btn"> Capture a poster </button>
                    <img class="mt-2 img-fluid img-thumbnail" src="{{ $video->poster }}" alt="">
                </div>
            </div>

        </div>
    </div>
    @include('admin.partials.edit-button')

</form>
@endsection
 @push('scripts')
<script>
    let path = @json(asset("storage/{$course->videosPath}"));
</script>
<script src="{{ asset_path('js/admin/videos/create.js') }}"></script>

@endpush