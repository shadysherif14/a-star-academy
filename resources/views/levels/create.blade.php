@extends('layouts.admin') 

@section('title', 'Admin Dashboard') 

@section('content')

<div class="z-depth-3">

    <h3 class="background p-3"> 
        Add New Level
    </h3>
    <form action="/levels" method="post" class="p-3">
        
        @csrf 
        
        <div class="md-form">
            <input type="text" name="name" id="name" class="form-control">
            <label for="name"> Level Name </label>
        </div>

        <div class="md-form">
            <input type="text" name="description" id="description" class="form-control">
            <label for="description"> Level Description </label>
        </div>

        <button type="submit" class="btn btn-elegant"> Add </button>
    </form>

</div>

@endsection



@section('scripts')

@endsection