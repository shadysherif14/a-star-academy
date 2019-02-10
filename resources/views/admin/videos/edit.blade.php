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
                <label>
                    <i class="fas fa-money-bill"></i>
                    <span> price </span>
                </label>
                <div class="row">

                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fas fa-infinity"></i>
                            </span>
                            <input type="text" id="max-times" value="{{ $video->max_times }}" name="max_times" class="form-control price unlimited" placeholder="Maximum times of access">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fas fa-infinity"></i>
                            </span>
                            <input type="text" id="max-price" name="max_price" value="{{ $video->max_price }}" class="form-control price unlimited" placeholder="Maximum times of access price">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-collection-item-1"></i>
                            </span>
                            <input type="text" value="{{ $video->one_price }}" name="one_price" class="form-control price" placeholder="One time access">
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