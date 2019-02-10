@extends('admin.layouts.create') 

@section('form')

<form action="{{ action('Admin\LevelController@update', $level) }}" method="post" class="card ajax" enctype="multipart/form-data">

    @csrf

    @include('admin.levels.form')

    @include('admin.partials.edit-button')

</form>

@endsection