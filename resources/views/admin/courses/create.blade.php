@extends('admin.layouts.create')

@section('header.text')
    <i class="fas fa-graduation-cap"></i> New Course
@endsection
    
@section('form')

<form action="{{ $endPoint }}" method="post" class="col-12 ajax" enctype="multipart/form-data">

    @csrf

    @include('admin.courses.form')

    @include('admin.partials.add-button')

</form>

@endsection