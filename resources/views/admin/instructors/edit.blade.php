@extends('admin.layouts.create')

@section('form')

<form action="{{ $instructor->adminRoutes->update }}" method="post" class="col-12 ajax" enctype="multipart/form-data">

    @csrf

    @include('admin.instructors.form')

    @include('admin.partials.edit-button')

</form>

@stop 