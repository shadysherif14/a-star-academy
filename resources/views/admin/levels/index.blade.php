@extends('layouts.admin') 

@section('title', '| Levels') 

@section('content')

<div class="card">

    <div class="card-header grid">
        <div> Name </div>
        <div> Description </div>
        <div> Image </div>
        <div>  </div>
    </div>

    <div class="card-body">
        
        @foreach ($levels as $level)
                
        <div id="level-{{ $level->id }}" level="{{ $level->id }}" class="grid">
        
            <div>
                <p class="link">
                    <a href="{{ $level->adminPath() }}"> {{ $level->name }} </a>
                </p>
            </div>
        
            <div>
                <div>
                    <p class="content"> Description </p>
                </div>
                <p class="text-left"> {!! $level->description !!} </p>
            </div>

            <div>
                <div>
                    <p class="content"> Image </p>
                </div>
                
                <img src="{{ $level->image }}" alt="Level">
            </div>
        
            <div class="actions">
                <a href="{{ $level->adminPath() }}" class="btn show">
                    <i class="fas fa-eye"></i> <span> Show </span> 
                </a>
            </div>
        </div>

        @endforeach
  
    </div>
</div>

@endsection
 
@section('scripts')
@endsection
 
@section('css')
    <link rel="stylesheet" href="{{ asset('css/levels/index.css') }}">
@endsection