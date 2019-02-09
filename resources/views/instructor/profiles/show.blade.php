@extends('layouts.instructor') 

@section('content')

<div class="row clearfix">
    <div class="col-11 mx-auto">
        <form action="{{ route('instructor.profile.update') }}" method="post" class="col-12 file-ajax" enctype="multipart/form-data">
        
            @csrf
            @include('instructor.profiles.form')
            @include('admin.partials.edit-button')
            
        </form>
    </div>
</div>

@endsection


@push('css')
    <link rel="stylesheet" href="{{ asset_path('assets/plugins/waitMe/waitMe.css') }}" />
    <link rel="stylesheet" href="{{ asset_path('assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" />
    <link rel="stylesheet" href="{{ asset_path('assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" />
@endpush

@push('scripts')
    <script src="{{ asset_path('assets/plugins/waitMe/waitMe.js') }}"></script>
    <script src="{{ asset_path('assets/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}"></script>
@endpush