$newWrapper = $('#new-question');

$('a[href="#new-question"]').on('shown.bs.tab', function (e) {

    let $answersWrapper = $newWrapper.find('.answers-wrapper');

    if ($answersWrapper.children().length) return;

    $answersWrapper.append(answerTemplate());

    $answersWrapper.append(answerTemplate());

});

let form; 
$('form.new-question, form.edit-question').submit(function (e) {

    e.preventDefault();

    form = $(this);

    submitForm(form, newQuestionCallback, defaultError);

});

const newQuestionCallback = response => {

    let question = response.question;

    $(`tr#question-${question.id}`).remove();

    let template = newQuestionTemplate(question);

    $questionsTable.find('tbody').append(template);

    $('a[href="#questions"]').tab('show');

    form.find('textarea').val(null);

    form.find('input').val(null);

    form.find('.answers-wrapper').empty();
}

const newQuestionTemplate = question => {

    let answers = question.answers;

    let correctAnswer = answers.find(answer => question.answer_id == answer.id);

    let wrongAnswers = answers.filter(answer => question.answer_id != answer.id);

    let template = `
    <tr id="question-${question.id}">
        <input type="hidden" name="questions[]" value="${question.id}">

        <td> ${question.body} </td>

        <td>
            <span class="text-success font-weight-bold"> ${correctAnswer.body} </span>
            ${wrongAnswers.map(answer => `<span class="font-weight-bold"> - ${answer.body} </span>`)}
        </td>

        <td> ${correctAnswer.body} </td>
        <td>
            <button type="button" href="#edit-question" 
            class="btn mx-2 l-parpl btn-icon btn-icon-mini btn-round edit-questions"
            action ="${question.admin_routes.show}" >
                <i class="zmdi zmdi-edit"></i>
            </button>
            <button type="button" class="btn l-coral btn-icon btn-icon-mini btn-round delete"
            action = "${question.admin_routes.destroy}" >
                <i class="zmdi zmdi-delete"></i>
            </button> 
        </td>
    </tr>
    `;

    return template;

}