let schoolSelect = $('select[name="school"]');

let levelSelect = $('select[name="level"]');

let prevSchool;

const filterLevelsBySchool = (school, levelID) => {

    prevSchool = school;

    let schoolLevels = levels.filter(level => level.school === school);

    if (schoolLevels.length === 0) return;

    let options = ``;

    schoolLevels.forEach(level => {

        if (levelID = level.id) {
            options += `<option value="${level.id}" selected> ${level.name} </option>`;

        } else {
            options += `<option value="${level.id}"> ${level.name} </option>`;
        }

    });

    levelSelect.html(options);

    if (schoolLevels.length === 1) {

        levelSelect.find('option').removeAttr('selected');

        let selectedOption = levelSelect.find('option');

        selectedOption.prop('selected', true);
    }

    levelSelect.parents('.form-group').removeClass('hidden');

    reInitializeSelect('#level');
}

if (course.id) {

    let school = course.school;

    filterLevelsBySchool(school, school.level_id);

    if (course.system) {

        $('#system').removeClass('hidden');

        let systemRadio = $(`input[name="system"][value="${course.system}"]`);

        systemRadio.prop('checked', true);
    }

    if (course.sub_system) {

        $('#sub_system').removeClass('hidden');
    
        console.log(course.sub_system);
        
        let subSystemRadio = $(`input[name="sub_system"][value="${course.sub_system}"]`);
    
        subSystemRadio.prop('checked', true);
    }


} else {

    $('#image-wrapper img').attr('src', null).addClass('hidden');

    $('#image-wrapper button').addClass('hidden');
}

schoolSelect.on('change', _ => schoolChanged());

const schoolChanged = _ => {

    let school = schoolSelect.val();

    if (prevSchool === school) return;

    removeErrors();

    filterLevelsBySchool(school, -1);

    if (school === 'IGCSE') {

        show('#system');

        show('#sub_system');

    } else {

        hide('#system');

        hide('#sub_system');
    }
}


const show = selector => $(selector).slideDown('slow').removeClass('hidden');

const hide = selector => $(selector).slideUp('slow').removeClass('grid').addClass('hidden');

const removeErrors = _ => {

    $('#system').parent().find('small').remove();

    $('#sub_system').parent().find('small').remove();
}