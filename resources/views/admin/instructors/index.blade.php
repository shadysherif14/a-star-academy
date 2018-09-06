@extends('layouts.admin') 

@section('title', '| Instuctors') 

@section('content')


<a class="btn create" href="{{ route('admin.instructors.create' ) }}">
    <i class="fas fa-plus"></i> Add Instructor
</a>


<div class="card">

    <div class="card-header grid">
        <div> </div>
        <div> Name </div>
        <div> About </div>
        <div>  </div>
    </div>

    <div class="card-body">
        
        @foreach ($instructors as $instructor)
                
        <div id="instructor-{{ $instructor->id }}" instructor="{{ $instructor->id }}" class="grid">
        
            <div class="avatar">
                <img src="{{ $instructor->avatar }}" alt="" class="img-fluid rounded-circle">
            </div>

            <div>
                <div>
                    <p class="content"> Name </p>
                </div>
                <p> {{ $instructor->name }} </p>
            </div>
            
            <div>
               <div>
                    <p class="content"> About </p>
                </div>
                <p> {{ $instructor->about }} </p>
                
            </div>
            <div>
                <div>
                    <p class="content"> Actions </p>
                </div>
                <div class="actions">
                    <a type="button" class="btn show" href="{{ route('admin.instructors.show', ['instructor' => $instructor]) }}">
                        <i class="fas fa-eye"> </i>
                    </a>
                    <a type="button" class="btn edit" href="{{ route('admin.instructors.edit', ['instructor' => $instructor]) }}">
                        <i class="fas fa-pen"> </i>
                    </a>
                    <button type="button" class="btn delete" action="{{ route('admin.instructors.destroy', ['instructor' => $instructor]) }}">
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
    <link rel="stylesheet" href="{{ asset('css/admin/instructors/index.css') }}">
@endsection