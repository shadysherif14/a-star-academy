@extends('layouts.admin') 

@section('title', '| Levels') 

@section('content')


<a class="btn create" href="{{ route('admin.levels.create' ) }}">
    <i class="fas fa-plus"></i> Add Level
</a>

@php
    if(count($levels) === 0) 
        $hidden = 'd-none';
    else   
        $hidden = '';
@endphp

@includeWhen( count($levels) == 0, 'includes.no_records', ['record' => 'level'])

<div class="card">

    <div class="card-header grid">
        <div> Name </div>
        <div> School </div>
        <div>  </div>
    </div>

    <div class="card-body">
        
        @foreach ($levels as $level)
                
        <div id="level-{{ $level->id }}" level="{{ $level->id }}" class="grid">
        
            <div>
                <p class="link">
                    <a href="{{ route('admin.levels.show', ['level' => $level]) }}"> {{ $level->name }} </a>
                </p>
            </div>
        
            <div>
                <div>
                    <p class="content"> School </p>
                </div>
                <p> {{  $level->school }} </p>
            </div>
        
            <div>
                <div>
                    <p class="content"> Actions </p>
                </div>
                <div class="actions">
                    <a type="button" class="btn show" href="{{ route('admin.levels.show', ['level' => $level]) }}">
                        <i class="fas fa-eye"> </i>
                    </a>
                    <a type="button" class="btn edit" href="{{ route('admin.levels.edit', ['level' => $level]) }}">
                        <i class="fas fa-pen"> </i>
                    </a>
                    <button type="button" class="btn delete" action="{{ route('admin.levels.destroy', ['level' => $level]) }}">
                        <i class="fas fa-trash"> </i>
                    </button>
                </div>
            </div>
        </div>

        @endforeach
  
    </div>
</div>

@endsection
 
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/levels/index.css') }}">
@endsection