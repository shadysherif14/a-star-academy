@extends('layouts.admin') 

@section('content')

<div class="row clearfix">
    <div class="col-11 mx-auto">
        @yield('form')
    </div>
</div>

@endsection


@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/waitMe/waitMe.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/form.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}"></script>
    <script src="{{ asset('assets/plugins/waitMe/waitMe.js') }}"></script>
@endpush