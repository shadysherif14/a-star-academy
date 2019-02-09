@extends('admin.layouts.create') 
@section('header.text')
@endsection
 
@section('form')


<form action="{{ action('Admin\LevelController@store') }}" method="post" class="ajax card" enctype="multipart/form-data">

    @include('admin.levels.form')

    @include('admin.partials.add-button')

</form>

@endsection
 
