@extends('admin.layouts.create') 
@section('form')

<form action="{{ $course->videosRoute('store') }}" id="form" method="POST" class="ajax" enctype="multipart/form-data">

    @csrf

    <div class="card">

        <div class="header">
            <h2> <strong>  <i class="fas fa-video"></i> New </strong> Sessions </h2>
        </div>

        <div class="body">

            <div class="fileinput fileinput-new" data-provides="fileinput">
                <span class="btn btn-primary btn-file">
                <span class=""> Select sessions </span>
                <input type="file" id="files" multiple accept="video/*"> </span>
            </div>

        </div>
    </div>

    <div id="videos" class="row clearfix"></div>

    <button type="submit" class="btn btn-primary w-50 mx-auto d-none"> 
        <i class="zmdi zmdi-upload"></i> Upload all session at once 
    </button>

</form>

<video class="d-none" id="video"></video>



@stop @push('scripts')
<script src="{{ asset('js/admin/videos/create.js') }}"></script>
@endpush