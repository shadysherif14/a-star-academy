@extends('layouts.admin') 

@section('content')

<div class="card">

    <div class="header">
        <h2><strong> {{ $title }} </strong> List</h2>
    </div>
    <div class="body table-responsive">    
        @yield('table')
    </div>
    
</div>

@endsection