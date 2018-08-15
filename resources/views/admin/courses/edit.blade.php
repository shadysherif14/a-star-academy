@extends('layouts.admin') 
@section('title', '| Courses - Edit') 
@section('content')

<form action="{{ route('admin.courses.update', ['course' => $course]) }}" method="post" class="card ajax" enctype="multipart/form-data">

    @csrf
    
    @method('put')

    <div class="card-header">
        <h4> <i class="fas fa-graduation-cap"></i> Edit Course </h4>
    </div>

    @include('admin.courses.form')

    <button type="submit" class="btn btn-submit"> <i class="fas fa-pen"></i> Edit </button>

</form>

@stop 

@section('scripts')
    <script src="{{ asset('js/courses/create.js') }}"></script>
@stop 

@section('css')
    <link rel="stylesheet" href="{{ asset('css/courses/create.css') }}"> 
@stop