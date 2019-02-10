@extends('admin.layouts.create') 

@section('header.text', 'Edit Course')
 
@section('form')

<form action="{{ $endPoint }}" method="post" class="col-12 ajax" enctype="multipart/form-data">

    @csrf

    @include('admin.courses.form')

    @include('admin.partials.edit-button')

</form>

@endsection