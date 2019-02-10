let questionsTable = document.querySelector('#questions tbody');

Sortable.create(questionsTable, {
    animation: 100,
    handle: '.handler',
    ghostClass: 'active'
});

let answersIndex = 3;

let $questionsTable = $('#questions');

let $newAnswerBtn = $('.add-new-answer');

$newAnswerBtn.on('click', function () {

    let $answers = $(this).closest('.body');

    let $answersWrapper = $answers.find('.answers-wrapper');

    $answersWrapper.append(answerTemplate());
});

$(document).on('click', '.remove', function () {

    let $btn = $(this);

    let $answers = $btn.closest('.answers');

    let $answersWrapper = $answers.find('.answers-wrapper');

    if ($answersWrapper.children().length < 3) {

        toastr.error('The answers cannot be less than two');

        return;
    }

    let $correctInput = $($btn.attr('href'));

    let inputAnswer = $correctInput.val();

    let $correctAnswerInput = $answers.find('input.correct_answer');

    let correctAnswer = $correctAnswerInput.val();

    // If the correct answer is the same as the answer that will be removed
    // Make the correct answer value equals to null
    if (correctAnswer === inputAnswer) {

        $correctAnswerInput.val(null);
    }
    $(this).closest('.form-group').remove();


});

$(document).on('click', '.correct', function () {

    let $btn = $(this);

    let correctInput = $($btn.attr('href'));

    let correctAnswer = correctInput.val();

    if (!correctAnswer) {

        toastr.error("The correct answer cannot be empty");

        return;
    }

    let $answers = $btn.closest('.answers');

    let $correctAnswerInput = $answers.find('input.correct_answer');

    $correctAnswerInput.val(correctAnswer);

});


$('form.order').on('submit', function (e) {

    e.preventDefault();

    submitForm($(this), orderSuccessCallback, defaultError);

});

const orderSuccessCallback = response => {

    toastr.success('Data is successfully updated.');
}

const answerTemplate = function (answer = '', id = -1, action = 'add') {

    let href = `${action}-answer-${answersIndex}`;

    let template = `
            <div class="form-group row answer">              
                <div class="col-9">
                    <input type="text" id="${href}" 
                    name="answers[${answersIndex}][body]" 
                    class="form-control" placeholder="Answer..." value="${answer}">
                    <input type="hidden" name="answers[${answersIndex}][id]" value="${id}">

                </div>

                <div class="col-3">
                    <button href="#${href}" type="button" class="btn l-green btn-icon btn-icon-mini btn-round correct">
                        <i class="zmdi zmdi-check"></i>
                    </button>

                    <button href="#${href}" type="button" class="btn l-coral btn-icon btn-icon-mini btn-round remove">
                        <i class="zmdi zmdi-delete"></i>
                    </button>
                </div>
            </div>
            `;

    answersIndex++;
    
    return template;
}


$('#questions-form').submit(function (e) {
   
    e.preventDefault();


    submitForm($(this));
});