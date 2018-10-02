@extends('admin.layouts.table') 
@section('table')



<form class="ajax" action="{{ route('admin.questions.order') }}" method="POST">
    <table class="table table-hover m-b-0" id="table">
        <thead>
            <tr role="row">
                <th> Question </th>
                <th> Answers </th>
                <th> Correct Answer </th>
                <th> Actions </th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
            <tr>
                <input type="hidden" name="questions[]" value="{{ $question->id }}">

                <td> {{ $question->body }} </td>

                <td>
                    @foreach ($question->answers as $answer)
                    <span class="{{ $answer->answerStyle() }}"> {{ $answer->body }} </span> @if(!$loop->last) - @endif @endforeach
                </td>

                <td> {{ $question->correct_answer }} </td>
                <td> 
                    <button type="button" class="btn l-parpl btn-icon btn-icon-mini btn-round modal-trigger" 
                    action="{{ $question->adminRoutes->show }}">
                        <i class="zmdi zmdi-edit"></i>
                    </button>
                    @include('admin.partials.actions', ['model' => $question, 'actions' => ['delete']])
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</form>
<button class="btn create modal-trigger" action="{{ route('admin.questions.store', ['video' => $video]) }}" method="create">
    <i class="fas fa-plus"></i> Add Question
</button>



<form class="modal fade show" id="modal" method="POST" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-body">

            </div>

        </div>
    </div>
</form>

@endsection
    @push('scripts')
<script src="{{ asset('js/admin/quizzes/index.js') }}"></script>


@endpush 
@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quizzes/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/form.css') }}">
@endpush