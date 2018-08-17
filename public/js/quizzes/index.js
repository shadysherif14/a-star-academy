Sortable.create(questions, {
    animation: 100,
    handle: '.handler',
    ghostClass: 'active'
});

let formModal = $('#modal');

let answersIndex;

$(document).on('click', '.modal-trigger', function () {

    let action = $(this).attr('action');

    let method = $(this).attr('method');

    formModal.find('.modal-header').remove();

    formModal.find('.btn-submit').remove();

    formModal.find('.modal-body').empty();

    answersIndex = 1;
    
    if (method === 'create') {

        createQuestion(action);

    } else {

        getQuestion(action, method);
    }
});



const getQuestion = function (action, method) {

    $.ajax({
        type: "GET",
        url: action,
        success: function (response) {

            method === 'edit' ? editQuestion(response.question, response.action) : showQuestion(response.question);
        }
    });
}


const showQuestion = function (question) {

    let body, header;

    header = `<div class="modal-header">
                <h3> ${question.body} </h3>
            </div>`;

    formModal.removeAttr('action');

    formModal.find('input[name="_method"]').remove();

    formModal.find('.modal-body').before(header);

    body = `
        <ul class='list-group'></ul>
    `;
    formModal.find('.modal-body').html(body);

    let answers = question.answers;

    let invisible = '';

    body = ``;

    answers.forEach((answer) => {

        if (answer.body === question.correct_answer) {
            invisible = '';
        } else {
            invisible = 'invisible';
        }
        answerTemplate = `

            <li class='list-group-item d-flex justify-content-between align-items-center'>
                <h5 class="mb-0"> ${answer.body} </h5>
                <i class="fas fa-check text-success fa-3x ${invisible}"></i>
            </li>
            
        `;
        body += answerTemplate;
    });

    formModal.find('.modal-body ul').html(body);

    formModal.modal('show');

}

const editQuestion = function (question, action) {

    method = `<input type="hidden" name="_method" value="put">`;

    header = `
            <div class="modal-header">
                <h3> Edit Question <i class='fas fa-question'></i> </h3>
            </div>
        `;

    body = `
        <div class="form-group">
            <textarea name="question" class="form-control" rows="4" placeholder="Type your question ...">${question.body}</textarea>
        </div>
        <div class="md-form">
            <select id="correct-answer" name="correct_answer" class="mdb-select">
                <option value="" disabled> Correct Answer: </option>
            </select>
            <label for="correct-answer"> Correct Answer: </label>
        </div>
        <div class="answers"></div>
    `;

    footer = `
            <button class="btn btn-submit"> 
                <i class="fas fa-pen"></i> Edit 
            </button>
        `;

    formModal.attr('action', action);

    formModal.prepend(method);

    formModal.find('.modal-body').before(header);

    formModal.find('.modal-body').html(body);

    formModal.find('.modal-body').after(footer);

    let answers = question.answers;

    answers.forEach(answer => {
        
        formModal.find('.answers').append(editAnswerTemplate(answer));

        let option;
        if(answer.body === question.correct_answer)
            option = `<option value="${answer.body}" selected> ${answer.body} </option>`;
        else {
            option = `<option value="${answer.body}"> ${answer.body} </option>`;
        }
        formModal.find('select').append(option)
    });

    showPlusIcon();

    $('.mdb-select').material_select();

    autosize($('textarea'));

    formModal.modal('show');

}

/** New Question */
const createQuestion = function (action) {

    method = `<input type="hidden" name="_method" value="post">`;

    header = `
            <div class="modal-header">
                <h3> New Question <i class='fas fa-question'></i> </h3>
            </div>
        `;

    body = `
        <div class="form-group">
            <textarea name="question" class="form-control" rows="4" placeholder="Type your question ..."></textarea>
        </div>
        <div class="md-form">
            <select id="correct-answer" name="correct_answer" class="mdb-select">
                <option value="" selected disabled> Correct Answer: </option>
            </select>
            <label for="correct-answer"> Correct Answer: </label>
        </div>
        <div class="answers">
            ${newAnswerTemplate()}
            ${newAnswerTemplate()}
        </div>
    `;

    footer = `
            <button class="btn btn-submit"> 
                <i class="fas fa-plus"></i> Add 
            </button>
        `;

    formModal.attr('action', action);

    formModal.prepend(method);

    formModal.find('.modal-body').before(header);

    formModal.find('.modal-body').html(body);

    formModal.find('.modal-body').after(footer);

    showPlusIcon();

    $('.mdb-select').material_select();

    autosize($('textarea'));

    formModal.modal('show');

}

$(document).on('click', '.answers i.fa-plus', function () {

    answersIndex++;

    $(this).addClass('invisible');

    formModal.find('.answers').append(newAnswerTemplate());

    showPlusIcon();
});

$(document).on('click', '.answers i.fa-minus', function () {

    if (childrenNumber('.answers') < 3) {

        toastr.error('The answers cannot be less than two');

        return;
    }

    $(this).parents('.form-group').remove();

    showPlusIcon();

    updateCorrectAnswersSelect();
});

$(document).on('click', '.answers i.fa-check', function () {

    let correctAnswerSelect = formModal.find('select');

    let correctInput = $(this).parents('.form-group').find('input.form-control');

    let correctAnswer = correctInput.val();

    if (correctAnswer == '') {

        toastr.error("The correct answer cannot be empty");

        return;
    }

    updateCorrectAnswersSelect();

    selectCorrectAnswer(correctAnswer);
});

$(document).on('blur', '.answers input.form-control', _ => updateCorrectAnswersSelect());

const selectCorrectAnswer = function (correctAnswer) {

    let correctAnswerSelect = formModal.find('select');

    correctAnswerSelect.material_select('destroy');

    $(`option[value="${correctAnswer}"]`).attr('selected', 'selected');

    correctAnswerSelect.material_select();

    $('.dropdown-content.select-dropdown').find(`span`).removeClass('active selected');

    $('.dropdown-content.select-dropdown').find(`span:contains(${correctAnswer})`).parent().addClass('active selected');

}

const updateCorrectAnswersSelect = function () {

    let correctAnswerSelect = formModal.find('select');

    let correctAnswer = correctAnswerSelect.val();

    correctAnswerSelect.empty();

    let optionsTemplate = '<option value="" selected disabled> Correct Answer: </option>';

    $('.answers').find('input.form-control').each(function () {

        let answerText = $(this).val();

        if (answerText === '') return;

        optionsTemplate += `<option value="${answerText}"> ${answerText} </option>`;

    });

    correctAnswerSelect.html(optionsTemplate);

    selectCorrectAnswer(correctAnswer);
}

const showPlusIcon = function () {

    $('.answers div').last().find('.fa-plus').removeClass('invisible');
}

const newAnswerTemplate = function () {

    let template = `
            <div class="form-group">
                <input type="text" name="answers[${answersIndex}]" class="form-control" placeholder="Answer">
                <div class="icons">
                    <i class="fas fa-plus invisible"></i>
                    <i class="fas fa-check"></i>    
                    <i class="fas fa-minus"></i>
                </div>
            </div>  
            `;

    answersIndex++;

    return template;
}

const editAnswerTemplate = function (answer) {

    let template = `
            <div class="form-group">
                <input type="text" name="answers[${answersIndex}][body]" class="form-control" value="${answer.body}" placeholder="Answer">
                <input type="hidden" name="answers[${answersIndex}][id]" class="form-control" value="${answer.id}">
                <div class="icons">
                    <i class="fas fa-plus invisible"></i>
                    <i class="fas fa-check"></i>    
                    <i class="fas fa-minus"></i>
                </div>
            </div>  
            `;

    answersIndex++;
    
    return template;
}

const childrenNumber = selector => $(selector).children().length;
/** New Question */


$('form.ajax').on('submit', function (e) {

    e.preventDefault();

    submitForm($(this), orderSuccessCallback, defaultError);
});
const orderSuccessCallback = function (response) {

    if (response.status) {

        $('i.fa-spin').remove();

        toastr.success('Data is successfully updated.');
    }
}

formModal.on('submit', function (e) {

    e.preventDefault();

    submitForm(formModal, successCallback, defaultError);
});


const successCallback = function (response) {

    if (response.status) {

        formModal.modal('hide');

        if (response.method === 'create') {
            
            $('.card-header').removeClass('d-none');

            $('.btn-submit').removeClass('d-none');

            $('#no-data').remove();

            $('#questions').append(newQuestionTemplate(response.question, response.actions));
        }

        if (response.method === 'edit') {
            
            console.log(response.question);
            
            let questionEl = $(`#question-${response.question.id}`);

            questionEl.find('.body').text(response.question.body);

            questionEl.find('.correct-answer').text(response.question.correct_answer);
        }
    }
}


const newQuestionTemplate = function (question, actions) {

    let template = `
        <div class="grid" id="question-${question.id}" question="${question.id}">
            <div>
                <input type="hidden" name="questions[]" value="${question.id}">
                <p> ${question.body} </p>
            </div>
            <div>
                <div>
                    <p class="content">
                        Correct Answer
                    </p>
                </div>
                <p> ${question.correct_answer} </p>
        
            </div>
            <div>
                <div>
                    <p class="content"> Actions </p>
                </div>
                <div class="actions">
                    <button type="button" class="btn btn-floating show modal-trigger"  method="show"
                            action="${actions.show}">                            
                        <i class="fas fa-eye"> </i>
                    </button>
                    <button type="button" class="btn btn-floating edit modal-trigger" method="edit"
                            action="${actions.show}">
                        <i class="fas fa-pen"> </i>
                    </button>
                    <button type="button" class="btn btn-floating delete" 
                            action="${actions.delete}">
                        <i class="fas fa-trash"> </i>
                    </button>
                </div>
            </div>
            <div class="icons d-none d-lg-block">
                <i class="fas fa-sort handler"></i>
            </div>
        </div>
        `;

    return template;
}