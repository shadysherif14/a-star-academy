<div class="tab-pane fade" id="new-question">

    <form class="card new-question" action="{{ $video->questionsRoute('store') }}" method="POST">

        @csrf

        <input type="hidden" name="video_id" value="{{ $video->id }}"> 

        <div class="header">
            <h2> <strong> Question <i class="fas fa-question"></i> </strong> </h2>
        </div>
        
        <div class="body">

            <div class="form-group">
                <textarea name="new_question" class="form-control" placeholder="Type your question ..."></textarea>
            </div>

            <div class="answers">

                <div class="form-group">
                    <label for="correct-answer"> Correct Answer: </label>
                    <input type="text" name="new_correct_answer" class="form-control correct_answer" placeholder="Correct Answer" readonly>
                </div>

                <label for=""> Answers </label>

                <div class="answers-wrapper"></div>

            </div>

            <div class="form-group">
                <button type="button" class="btn bg-primary add-new-answer"> Add Answer </button>
            </div>

        </div>

        @include('admin.partials.add-button')

    </form>
</div>