@extends('admin.layouts.create') 
 
@section('form')

<form action="{{ adminStaticRoute('Instructor', 'store') }}" method="post" class="col-12 ajax" enctype="multipart/form-data">

    @csrf

    @include('admin.instructors.form')

    @include('admin.partials.add-button')

</form>

@stop 
