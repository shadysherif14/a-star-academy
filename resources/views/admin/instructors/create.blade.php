@extends('layouts.admin') 

@section('title', ' | Instructors - Create') 

@section('content')

<form action="{{ route('admin.instructors.store') }}" method="post" class="card ajax" enctype="multipart/form-data">

    @csrf

    <div class="card-header">
        <h4> <i class="fas fa-chalkboard-teacher"></i> New Instructor </h4>
    </div>

    @include('admin.instructors.form')

    <button type="submit" class="btn btn-submit"> <i class="fas fa-plus"></i> Add </button>

</form>


@stop 

@section('scripts')

    <script>
        let instructor = @json($instructor);
    </script>
    <script src="{{ asset('js/admin/instructors/create-edit.js') }}"></script>
    <script src="{{ asset('js/admin/levels-courses/create-edit.js') }}"></script>    
@stop 

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/shared/cru.css') }}"> 
@stop