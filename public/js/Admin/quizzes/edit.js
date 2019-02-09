$editBtn = $('.edit-questions');

$editWrapper = $('#edit-question');

$(document).on('click', '.edit-questions', function () {

    let $btn = $(this);

    $.get($btn.attr('action'))

        .done(response => {

            let question = response.question;

            console.log(question.id);

            let answers = question.answers;

            answersIndex = 1;

            let correctAnswer = question.correct_answer;

            $editWrapper.find('form').attr('action', question.admin_routes.update);

            $editWrapper.find('textarea[name="question"]').val(question.body);

            $editWrapper.find('input[name="question_id"]').val(question.id);

            $editWrapper.find('input[name="correct_answer"]').val(correctAnswer.body);

            let $answersWrapper = $editWrapper.find('.answers-wrapper');

            $answersWrapper.empty();

            answers.forEach(answer => {

                $answersWrapper.append(answerTemplate(answer.body, answer.id, 'edit'));

            });

        });

    showTab($btn.attr('href'));

});

function showTab(tab) {

    $('.tab-pane').removeClass('show active');

    $('.nav-tabs a').removeClass('active');

    $(tab).addClass('show active');

    $(`a[href="${tab}"]`).addClass('active');
};