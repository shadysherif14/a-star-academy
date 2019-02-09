@extends('layouts.user')
@section('content')
    <div class="w-75 mx-auto">
        @includeWhen($policy === "terms", 'terms.terms')
        @includeWhen($policy === "cookies", 'terms.cookies')
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset_path('css/user/home.css') }}">
@endpush
    