@extends('layouts.admin') 

@section('title', 'Levels - Edit') 

@section('content')


<form action="{{ route('admin.levels.update', ['level' => $level]) }}" method="post" class="card ajax" enctype="multipart/form-data">

    @csrf

    <div class="card-header">

        <h4> <i class="fas fa-list"></i> Edit Level </h4>

    </div>

    @include('admin.levels.form')

    <button type="submit" class="btn btn-submit"> <i class="fas fa-pen"></i> Edit </button>

</form>

@endsection

@section('scripts')
    <script src="{{ asset('js/admin/levels-courses/create-edit.js') }}"></script>    
@stop 

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/shared/cru.css') }}">
@endsection