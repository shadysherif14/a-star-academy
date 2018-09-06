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

let schoolSelect = $('select[name="school"]');

let levelSelect = $('select[name="level"]');


let prevSchool;

schoolSelect.on('change', _ => schoolChanged());

const schoolChanged = _ => {

    let school = schoolSelect.val();

    if (prevSchool === school) return;

    removeErrors();

    prevSchool = school;

    let schoolLevels = levels.filter(level => level.school === school);

    if (schoolLevels.length === 0) return;

    let options = `<option value="" disabled selected> Choose Level </option>`;

    schoolLevels.forEach(level => {

        options += `<option value="${level.id}"> ${level.name} </option>`;

    });

    levelSelect.html(options);

    if (schoolLevels.length === 1) {

        levelSelect.find('option').removeAttr('selected');

        let selectedOption = levelSelect.find('option').eq(1);

        selectedOption.prop('selected', true);
    }

    levelSelect.parents('.md-form').slideDown('slow').removeClass('hidden');

    reInitializeSelect('#level');

    if (school === 'IGCSE') {

        show('#system');

        show('#sub_system');

    } else {

        hide('#system');

        hide('#sub_system');
    }
}

const show = selector => $(selector).slideDown('slow').addClass('grid').removeClass('hidden');

const hide = selector => $(selector).slideUp('slow').removeClass('grid').addClass('hidden');

const removeErrors = _ => {

    $('#system').parent().find('small').remove();

    $('#sub_system').parent().find('small').remove();
}