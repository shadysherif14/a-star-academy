$('.control-btn').on('click', function () {

    let time = 500;

    let btn = $(this);

    let target = $(this).attr('href');

    $(this).closest('.step').slideUp(time);

    setTimeout(() => {

        $(target).slideDown(time);

    }, time + 200);

});


$levels = $('#level');

const filterLevelsBySchool = (school) => {

    $levels.fadeOut('slow');

    let schoolLevels = levels.filter(level => level.school === school);

    if (schoolLevels.length === 0) return;

    let radios = `
    <label class="label"> 
        School Level <span class="text-danger align-middle font-20">*</span>
    </label>`;

    let img = $levels.attr('image');

    schoolLevels.forEach(level => {

        radios += `
            <div class="pretty p-jelly p-image p-plain">
                <input type="radio" name="level" value="${level.id}" />
                <div class="state">
                    <img src="${img}" class="icon" />
                    <label> ${level.name} </label>
                </div>
            </div>
        `
    });

    $levels.html(radios);

    if (schoolLevels.length > 1) {

        $levels.fadeIn('slow');

        return;
    }

    let $selectedRadio = $levels.find('input');

    $selectedRadio.prop('checked', true);
}

$('.btn-file input').on('change', function () {

    let image = this.files ? this.files[0] : undefined;

    let $input = $(this).parent().next();

    image ? $input.val(image.name).fadeIn() : $input.val(null).fadeOut();

});

$('input[name="school"]').on('change', function () {

    school = $(this).val();

    filterLevelsBySchool(school);
});


$('.controls').on('click', function () {

    $parent = $(this).closest('.steps');

    let $form = $parent.closest('form');

    if ($parent.hasClass('step-1')) {

        $form.attr('action', $parent.attr('action'));

        submitFileForm($form.get(0), step1Success, step1Error);

        return;
    }

    $sibling = $parent.siblings('.steps');

    $parent.slideToggle('slow', function () {

        $sibling.slideToggle('slow');

    });

});

const step1Success = () => {

    $step = $('.step-1');

    $step.find('.errors').empty();

    $step.slideToggle('slow', function () {

        $sibling = $('.step-2');

        $sibling.parent('form').attr('action', $sibling.attr('action'));

        $sibling.slideToggle('slow');

    })
};

const step1Error = response => {

    let errors = response.responseJSON ? response.responseJSON.errors : {};

    $step = $('.step-1');

    $errors = $step.find('.errors');

    $errors.empty();

    for (const key in errors) {

        let error = errors[key];

        let template = `<li> ${error} </li>`;

        $errors.append(template);
    }
};

$('form').on('submit', function (e) {
    
    e.preventDefault();
    let that = this;
    swal.fire({
      title: 'Terms and conditions',
      type:'info',
      animation: false,
      width: '80vw',
      html:`<div class="terms-wrapper w-100 h-100 mx-auto" style="color:#111;">
      <div class="my-4">
            <p class="font-italic">Thank you for using A-Star Academy. Please read the following terms, conditions carefully.</p>
            <p class="text-left">By agreeing on our Copyright and Trademark Policy, you are confirming that has been notified not to share,
                or distribute any of our courses, services and/or materials without written permission issued by A-Star
                Academy administration. That includes
                <br/>
                (a) Sharing our videos, courses, services, materials and anything published on our website with other
                parties;<br/>
                (b) Selling, renting or making profit using any of our resources;<br/>
                (c) Use any of our resources in any form outside our only website “astaracademy.net”<br/>
                Violating any of the above terms, policies will make you responsible and A-Star Academy has all rights to
                legally sue you.</p> 
        </div></div>`,
      input: 'checkbox',
      inputValue: 0,
      inputPlaceholder:
        `<div class="terms-consent">
            <span>I agree to A-Star Academy's <a href="/terms" target="_blank" class="text-danger" style="text-decoration: underline;">Terms and conditions</a> and <a href="/cookies" target="_blank" class="text-danger" style="text-decoration: underline;"> Cookie & Privacy Policy.</a></span>
        </div>`,
      confirmButtonText:
        'Complete Signup',
      inputValidator: (result) => {
        return !result && 'You need to agree with Terms & Conditions to complete signup process.'
      }
    }).then((result) => {
      if (result.value) {
        submitFileForm(that)

      }
    })
    
     
});
