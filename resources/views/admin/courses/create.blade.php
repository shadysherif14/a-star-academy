@extends('layouts.admin') 

@section('title', ' | Courses - Create') 

@section('content')

<form action="{{ route('admin.courses.store') }}" method="post" class="card ajax" enctype="multipart/form-data">

    @csrf

    <div class="card-header">
        <h4> <i class="fas fa-graduation-cap"></i> New Course </h4>
    </div>

    @include('admin.courses.form')

    <button type="submit" class="btn btn-submit"> <i class="fas fa-plus"></i> Add </button>

</form>


@stop 

@section('scripts')

    <script>
        let course = @json($course);
    </script>

    <script src="{{ asset('js/courses/create-edit.js') }}"></script>
    <script src="{{ asset('js/levels-courses/create-edit.js') }}"></script>    
@stop 

@section('css')
    <link rel="stylesheet" href="{{ asset('css/courses/create.css') }}"> 
@stop