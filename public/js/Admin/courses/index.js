let selectedCourses;

$('#school-filter').change(function () {

    let school = $(this).val();

    let selectedLevels;

    if (school) {

        selectedLevels = levels.filter(level => level.school === school);
    }

    let options = `<option value="" selected="selected"> All Levels </option>`;

    selectedLevels.forEach(level => {

        options += `<option value="${level.id}"> ${level.name} </option>`;
    });

    $('#level-filter').html(options);

    reInitializeSelect('#level-filter');
});


$('#filter-form').submit(function (e) {

    e.preventDefault();

    let form = $(this);

    submitForm(form, filterData, defaultError);
});

const filterData = response => {

    let value;

    selectedCourses = response.courses;

    value = $('#school-filter').val();

    if (value) filter(value, 'school');

    if (value === 'IGCSE' || value === '') {

        value = $('#system-filter').val();

        if (value) filter(value, 'system');

        value = $('#sub_system-filter').val();

        if (value) filter(value.toUpperCase(), 'sub_system');

    }

    value = $('#level-filter').val();

    if (value) filter(parseInt(value), 'level_id');

    value = $('#instructor-filter').val();

    if (value) filter(parseInt(value), 'instructor_id');

    $('.course').removeClass('d-none').addClass('d-none');

    if (selectedCourses.length > 0) {
        selectedCourses.forEach(course => {
            $(`#course-${course.id}`).removeClass('d-none');
        });
    } else {
        $('.course').removeClass('d-none');
    }
}

const filter = (value, filterBy) => {
    selectedCourses = selectedCourses.filter(course => course[filterBy] === value);
}

$('#table').DataTable({
    buttons: {
        buttons: [{
            text: 'Alert',
            action: function (e, dt, node, config) {
                alert('Activated!');
                this.disable(); // disable button
            }
        }]
    },
    "paging": true,
    "ordering": true,
    "info": true,
});

$('a.toggle-vis').on('click', function (e) {
    e.preventDefault();

    // Get the column API object
    var column = table.column($(this).attr('data-column'));

    // Toggle the visibility
    column.visible(!column.visible());
});