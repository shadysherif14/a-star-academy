@extends('layouts.admin') 
@section('content')


<div class="card">

    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#questions"> All Question </a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#new-question"> New Question </a></li>
    </ul>

</div>

<div class="tab-content">
  
    @include('admin.quizzes.table')

    @include('admin.quizzes.create')

    @include('admin.quizzes.edit')

</div>

@endsection
@push('scripts')
<script src="{{ asset_path('js/admin/quizzes/index.js') }}"></script>
<script src="{{ asset_path('js/admin/quizzes/create.js') }}"></script>
<script src="{{ asset_path('js/admin/quizzes/edit.js') }}"></script>

@endpush @push('css')
    <link rel="stylesheet" href="{{ asset_path('assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset_path('css/admin/quizzes/index.css') }}">
    <link rel="stylesheet" href="{{ asset_path('css/admin/form.css') }}"> 
@endpush