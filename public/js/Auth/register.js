$('#basic-info-btn').on('click', function (params) {

    let basicInfoEl = $('#basic-info');

    sendRequest(basicInfoEl);
});

let courses;

let index = 0;

const sendRequest = function (element) {

    let form = document.querySelector('form.ajax');

    let form$ = $(form);

    let action = element.attr('action');

    form$.attr('action', action);

    submitFileForm(form, basicInfoCallback, defaultError);
}

const basicInfoCallback = function (response) {

    if (response.status) {

        let school = $('input[name=school]:checked').val();

        let level = $('input[name=level]:checked').val();
                
        if (school !== 'IGCSE' || level !== 'IG') {
                    
            register();

            return;
        }

        let animation = 'bounce';

        $('#basic-info').parent('.body').animateCss(`${animation}Out`, function () {

            $('#basic-info').addClass('hidden');

            courses = response.courses;

            showCourse('next');

            $('#courses-info').removeClass('hidden');

            $('#courses-info').parent('.body').animateCss(`${animation}In`);

        });
    }
}


const register = _ => {

    let form = $('form.ajax');

    let action = form.attr('main_action');
    
    form.attr('action', action);

    $('form.ajax').submit();

}


let schoolRadio = $('input[type=radio][name=school]')

let schoolLabels = $('#school label');

schoolLabels.on('click', function () {

    setTimeout(() => {

        let school = $('input[name=school]:checked').val();

        let levels = $("#level").parent();

        if (school === 'IGCSE' && levels.hasClass('hidden')) {

            levels.addClass('grid').removeClass('hidden');

            levels.animateCss('bounceInRight');

        } else if (school === 'American Diploma' && levels.hasClass('grid')) {

            levels.animateCss('bounceOutLeft', function () {

                levels.addClass('hidden').removeClass('grid');
            });
        }
    }, 200);
});



$(document).on('click', '.course-prev', _ => {

    index--;

    showCourse('prev');
});

const checkSystem = function (msg) {
    
    let system = $(`input[name="courses[${index}][system]"]:checked`).val();

    let subsystem = $(`input[name="courses[${index}][subsystem]"]:checked`).val();

    if (system === undefined || subsystem == undefined) {

      $("#error-msg").text(msg);

      $("#error-modal").modal("show");

        return false;
    }

    return true;
}
$(document).on('click', '.course-submit', _ => {

    let msg = `You have to choose the course's system and the course's subsystem to join.`;
    
    if (checkSystem(msg)) {

        register();
    }
    
});

$(document).on('click', '.course-next', _ => {

    let msg = `You have to choose the course's system and the course's subsystem to proceed to the next courses.`;

    if (checkSystem(msg)) {

        index++;
    
        showCourse('next');
    }
});

const showCourse = function (action) {

    let course = courses[index];

    let coursesContainer = $('#courses-info');

    let prev = action == 'prev';

    if (prev) {

        coursesContainer.parent('.body').animateCss('bounceOutRight', function () {

            coursesContainer.find('.course-config').hide();

            $(`#${course}`).show().removeClass('animated bounceOutRight');

            coursesContainer.parent('.body').animateCss('bounceInLeft');
        });

        return;

    } else if (exists(`#${course}`)) {

        coursesContainer.parent('.body').animateCss('bounceOutLeft', function () {

            coursesContainer.find('.course-config').hide();

            $(`#${course}`).show().removeClass('animated bounceOutRight');

            coursesContainer.parent('.body').animateCss('bounceInRight');
        });

        return;
    }

    let btnNext = `<button type="button" class="btn course-next float-right"> <i class="fas fa-angle-right"></i> Next </button>`;

    let btnPrev = `<button type="button" class="btn course-prev float-left"> <i class="fas fa-angle-left"></i> Previous </button>`;

    let btnSubmit = `<button type="button" class="btn course-submit float-right"> <i class="fas fa-smile"></i> Join </button>`;

    courseTemplate = `
            <div class='course-config' id="${course}">
             <div class="header">
                <h4> ${course} </h4>
                <input type="hidden" name="courses[${index}][name]" value="${course}">
            </div>
            <div parent="system" class="btn-group-wrapper">
                <div class="btn-group grid" data-toggle="buttons" id="system-${course}">
                     <label class="btn form-check-label">
                        <input class="form-check-input" type="radio" name="courses[${index}][system]" value="Cambridge"> Cambridge
                    </label>
                     <label class="btn form-check-label">
                        <input class="form-check-input" type="radio" name="courses[${index}][system]" value="Edexcel"> Edexcel
                    </label>

                </div>
            </div>

            <div parent="sub_system" class="btn-group-wrapper">
                <div class="btn-group grid sub_system" data-toggle="buttons" id="sub-system-${course}">
                    <label class="btn form-check-label">
                        <input class="form-check-input" type="radio" name="courses[${index}][subsystem]" value="A2"> A2 
                    </label>
                    <label class="btn form-check-label">
                        <input class="form-check-input" type="radio" name="courses[${index}][subsystem]" value="AL"> AL
                    </label>
                    <label class="btn form-check-label">
                        <input class="form-check-input" type="radio" name="courses[${index}][subsystem]" value="OL"> OL
                    </label>
                    <label class="btn form-check-label">
                        <input class="form-check-input" type="radio" name="courses[${index}][subsystem]" value="AS"> AS
                    </label>

                </div>
            </div>
            <div class="controls">`;

    if (index === 0) {

        courseTemplate += `<div></div>` + btnNext;

    } else if (index === course.length - 1) {

        courseTemplate += btnPrev;

        courseTemplate += btnSubmit;

    } else {

        courseTemplate += btnPrev;

        courseTemplate += btnNext;
    }

    courseTemplate += `</div> </div>`;

    coursesContainer.parent('.body').animateCss('bounceOutLeft', function () {

        coursesContainer.find('.course-config').hide();

        coursesContainer.append(courseTemplate);

        coursesContainer.parent('.body').animateCss('bounceInRight');
    });

}