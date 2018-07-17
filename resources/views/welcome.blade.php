@extends('layouts.app')


@section('content')

<ul class="list-group">
    <li class="list-group-item">Shady</li>
    <li class="list-group-item">Lobna</li>
</ul>

<div class="btn btn-amber"> <i class="fas fa-user" aria-hidden="true"></i> Hello World </div>

<div class="md-form">
    <input placeholder="Selected date" type="text" id="date-picker-example" datepicker class="form-control">
    <label for="date-picker-example">Try me...</label>
</div>

@endsection