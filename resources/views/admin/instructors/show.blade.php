@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')

<div class="card r-crud">
    
    <div class="card-header">

        <h4> <i class="fas fa-list"></i>  Instructor </h4>

    </div>

    <div class="card-body">

        <h2> Instructor Name </h2>
        <p> {{ $instructor->name }} </p>

        <h2> Instructor About </h2>
        <p> {{ $instructor->about }} </p>

        <img src="{{ $instructor->avatar }}" alt="Instructor Image">
    </div>

</div>
@stop
 
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/shared/cru.css') }}">
@stop