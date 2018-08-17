@extends('layouts.admin')

@section('title', ' | Quizzes')

@section('content')

<button class="btn create modal-trigger" action="{{ route('admin.quizzes.store', ['video' => $video]) }}" method="create">
    <i class="fas fa-plus"></i> Add Question
</button>


@php
    if(count($questions) === 0) 
        $hidden = 'd-none';
    else   
        $hidden = '';
@endphp

@includeWhen( count($questions) == 0, 'includes.no_records', ['record' => 'question'])

<form class="card ajax" action="{{ route('admin.quizzes.order') }}" method="POST">

    @csrf

    @method('put')
  
    <div class="card-header grid {{ $hidden }}">
        <div> Question </div>
        <div> Correct Answer </div>
        <div>  </div>
    </div>

    <div class="card-body" id="questions">

        @foreach($questions as $question)

        <div class="grid" id="question-{{ $question->id }}" question="{{ $question->id }}">

            <div>
                <input type="hidden" name="questions[]" value="{{ $question->id }}">
                <p class="body"> {{ $question->body }} </p>
            </div>

            <div>
                <div>
                    <p class="content">
                        Correct Answer
                    </p>
                </div>
                <p class="correct-answer"> {{ $question->correct_answer }}</p>
        
            </div>
            <div>
                <div>
                    <p class="content"> Actions </p>
                </div>
                <div class="actions">
                    <button type="button" class="btn btn-floating show modal-trigger"  method="show"
                            action="{{ route('admin.quizzes.show', ['question' => $question]) }}">                            
                        <i class="fas fa-eye"> </i>
                    </button>
                    <button type="button" class="btn btn-floating edit modal-trigger" method="edit"
                            action="{{ route('admin.quizzes.show', ['question' => $question]) }}">
                        <i class="fas fa-pen"> </i>
                    </button>
                    <button type="button" class="btn btn-floating delete" 
                            action="{{ route('admin.quizzes.destroy', ['question' => $question]) }}">
                        <i class="fas fa-trash"> </i>
                    </button>
                </div>
            </div>

            <div class="icons d-none d-lg-block">
                <i class="fas fa-sort handler"></i>
            </div>

        </div>

        @endforeach

    </div>

    <button class="btn btn-submit {{ $hidden }}" type="submit">
        <i class="fas fa-pen"> Update </i>
    </button>

</form>

<form class="modal ajax bounceIn animated" id="modal" method="POST" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-danger">

        <div class="modal-content">
            
            <div class="modal-body">

            </div>

        </div>
    </div>
</form>
@endsection

@section('scripts')
    <script src="{{ asset('js/admin/quizzes/index.js') }}"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quizzes/index.css') }}">
@endsection



