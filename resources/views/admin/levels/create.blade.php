@extends('layouts.admin') 

@section('title', 'Levels - Create') 

@section('content')


<form action="{{ route('admin.levels.store') }}" method="post" class="card ajax" enctype="multipart/form-data">

    @csrf

    <div class="card-header">

        <h4> <i class="fas fa-list"></i> New Level </h4>

    </div>

    @include('admin.levels.form')

    <button type="submit" class="btn btn-submit"> <i class="fas fa-plus"></i> Add </button>

</form>
@endsection

@section('scripts')
    <script src="{{ asset('js/admin/levels-courses/create-edit.js') }}"></script>
@stop 

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/shared/cru.css') }}">
@endsection