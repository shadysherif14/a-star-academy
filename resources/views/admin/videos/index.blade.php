@extends('layouts.admin') 
@section('title', 'Admin Dashboard') 
@section('content')


<div class="card">

    <div class="card-body">

        <form action="/admin/{{ $course->slug }}/videos" method="post" enctype="multipart/form-data">

            @csrf

            <div class="md-form">

                <div class="file-field">

                    <a class="btn-floating elegant-color-dark mt-0 float-left">
                        <i class="fas fa-video" aria-hidden="true"></i> <input type="file" name="videos[]" multiple>
                    </a>

                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload a new video">
                    </div>

                </div>

                <small class="text-danger d-block font-weight-bold"> {{ $errors->first('video') }} </small>

            </div>

            <button class="btn btn-dark">
                <i class="fas fa-upload mr-3"></i> Upload
            </button>

        </form>

        <table class="table table-fixed" datatable>

            <thead class="elegant-color align-items-center text-white">
                <tr>
                    <th scope="col" class="name"> Name </th>
                    <th scope="col" class="actions"> Actions </th>
                </tr>
            </thead>

            <tbody>

                @foreach($videos as $video)

                <tr id="video-{{ $video->id }}" video="{{ $video->id }}" class="">

                    <td>
                        <p> {{ $video->title }} </p>
                    </td>

                    <td>
                        <button class="btn bttn-fill bttn-xs bttn-primary modal-trigger" video="{{ asset('storage') . '/' . $video->path }}/"> 
                            <i class="fas fa-eye"></i> <span> Show </span> 
                        </button>

                        <a href="/admin/videos/{{ $video->id }}/edit" class="btn bttn-fill bttn-xs bttn-success">
                            <i class="fas fa-pen"></i> <span> Edit </span> 
                        </a>
                        
                        <button class="btn bttn-fill bttn-xs bttn-danger delete">
                            <i class="fas fa-trash"></i> <span> Delete </span>
                        </a>
                    </td>
                </tr>

                @endforeach
            </tbody>

        </table>

    </div>

</div>


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
 
@section('css') {{--
<link rel="stylesheet" href="{{ asset('css/courses/index.css') }}"> --}}
@endsection