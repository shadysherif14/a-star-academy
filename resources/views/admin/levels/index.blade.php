@extends('layouts.admin') 

@section('title', '| Levels') 

@section('content')

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
 
@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/levels/index.css') }}">
@endpush