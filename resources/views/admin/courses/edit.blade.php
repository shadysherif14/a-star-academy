@extends('layouts.admin') 

@section('title', ' | Courses - Edit') 

@section('content')

<form action="{{ route('admin.courses.update', ['course' => $course]) }}" method="post" class="card ajax" enctype="multipart/form-data">

    @csrf
    
    <div class="card-header">
        <h4> <i class="fas fa-graduation-cap"></i> Edit Course </h4>
    </div>

    @include('admin.courses.form')

    <button type="submit" class="btn btn-submit"> <i class="fas fa-pen"></i> Edit </button>

</form>

@stop 

@section('scripts')

    <script>
        let course = @json($course);
        let levels = @json($levels);
    </script>
    
    <script src="{{ asset('js/admin/courses/create-edit.js') }}"></script>
    <script src="{{ asset('js/admin/levels-courses/create-edit.js') }}"></script>
@stop 


@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/shared/cru.css') }}"> 
@stop