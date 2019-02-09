@extends('layouts.admin') 

@section('title', 'Admin Dashboard') 

@section('content')

<div class="card r-crud">

    <div class="card-header">

        <h4> <i class="fas fa-list"></i>  Level Details </h4>

    </div>

    <div class="card-body">

        <h2> Level Name </h2>
        <p> {{ $level->name }} </p>

        <h2> Level Description </h2>
        <p> {!! $level->description !!} </p>

        <h2> Cover Image </h2>
        <img src="{{ $level->image }}" alt="Level Image">
    </div>

</div>
@endsection
 
@section('css')
    <link rel="stylesheet" href="{{ asset_path('css/admin/shared/cru.css') }}">
@endsection