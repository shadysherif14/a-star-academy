<div class="tab-pane fade show active" id="questions">
    <form class="card ajax" action="{{ action('Admin\QuestionController@order') }}" method="POST" id="questions-form">

        @method('PUT')
        <div class="header">
            <h2><strong> {{ $title }} </strong> List</h2>
        </div>
        <div class="body table-responsive">
            <table class="table table-hover m-b-0" id="table">
                <thead>
                    <tr role="row">
                        <th> Question </th>
                        <th> Answers </th>
                        <th> Correct Answer </th>
                        <th> Actions </th>
                        <th> Reorder </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $question)
                    <tr id="question-{{ $question->id }}">
                        <input type="hidden" name="questions[]" value="{{ $question->id }}">

                        <td> {{ $question->body }} </td>

                        <td>
                            @foreach ($question->answers as $answer)
                            <span class="font-weight-bold {{ $answer->answerStyle() }}"> {{ $answer->body }} </span> @if(!$loop->last)
                            - @endif @endforeach
                        </td>

                        <td> {{ $question->correctAnswer->body }} </td>
                        <td>
                            <button type="button" href="#edit-question" 
                            class="btn l-parpl btn-icon btn-icon-mini btn-round edit-questions" 
                            action="{{ $question->adminRoutes->show }}">
                                <i class="zmdi zmdi-edit"></i>
                            </button>
                            @include('admin.partials.actions', ['model' => $question, 'actions' => ['delete']])
                        </td>

                        <td>
                            <button type="button" class="btn l-slategray btn-icon btn-icon-mini btn-round handler">
                                <i class="fas fa-sort"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="footer">
            @include('admin.partials.edit-button')
        </div>
    </form>
</div>