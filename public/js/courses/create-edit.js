if (course.length != 0) {

    let schoolRadio = $(`input[name="school"][value="${course.school}"]`);

    schoolRadio.attr('checked', 'checked');

    schoolRadio.parent('label').addClass('active');

    if (course.school === 'IGCSE') {

        $('#system').addClass('hidden').addClass('grid');

        let systemRadio = $(`input[name="system"][value="${course.system}"]`);

        systemRadio.attr('checked', 'checked');

        systemRadio.parent('label').addClass('active');

        $('#sub_system').addClass('hidden').addClass('grid');

        let subSystemRadio = $(`input[name="sub_system"][value="${course.sub_system}"]`);

        subSystemRadio.attr('checked', 'checked');

        subSystemRadio.parent('label').addClass('active');
    }

} else {

    $('#image-wrapper img').attr('src', null).addClass('hidden');

    $('#image-wrapper button').addClass('hidden');
}

let schoolRadio = $('input[type=radio][name=school]')

let schoolLabels = $('#school label');

schoolLabels.on('click', function () {

    setTimeout(() => {

        let school = $('input[name=school]:checked').val();

        if (school === 'IGCSE') {

            $('#system').slideDown('slow').addClass('grid').removeClass('hidden');

            $('#sub_system').slideDown('slow').addClass('grid').removeClass('hidden');

        } else if (school === 'American Diploma') {

            $('#system').slideUp('slow').removeClass('grid').addClass('hidden');

            $('#sub_system').slideUp('slow').removeClass('grid').addClass('hidden');
        }
    }, 200);
});