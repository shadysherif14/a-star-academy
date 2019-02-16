@extends('layouts.admin') 

@section('content')

<div class="card">

    <div class="header">
        <h2 class="float-left"><strong> {{ $title }} </strong> List</h2>
        <div class="float-right">
            <button id="showAll" class="btn btn-success float-left">Show All Users</button>
            <button id="showBlocked" class="btn btn-danger float-right">Show Blocked Users Only</button>
        </div>
    </div>
    <div class="body table-responsive">    
        @yield('table')
    </div>
    
</div>

@endsection