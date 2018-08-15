console.log(2);

let schoolRadio = $('input[type=radio][name=school]')

let schoolLabels = $('#school label');

schoolLabels.on('click', function () {

    setTimeout(() => {

        let school = $('input[name=school]:checked').val();

        if (school === 'IGCSE') {

            $('#system').slideDown('slow').addClass('grid');

            $('#sub_system').slideDown('slow').addClass('grid');
        } else if (school === 'American Diploma') {

            $('#system').slideUp('slow').removeClass('grid');

            $('#sub_system').slideUp('slow').removeClass('grid');
        }
    }, 200);
});


$('form.ajax').submit(function (e) {

    e.preventDefault();

    let form = $(this);

    let submitButton = form.find('.btn-submit');

    let loading = `<i class="fas fa-circle-notch fa-spin"></i>`;

    submitButton.append(loading);

    submitForm(form, successCallback, defaultError);
});

const successCallback = function (response) {
    
    if (response.status) {

        //window.location = response.redirect;
    }
}

$('input[type=file]').on('change', function () {

    readURL(this);
});

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image-wrapper img').attr('src', e.target.result).removeClass('hidden');
            $('#image-wrapper button').removeClass('hidden');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$('#image-wrapper button').click(function () {
    
    $('input[type=file]').val(null);
    $('.file-path').val(null);
    $('#image-wrapper img').addClass('hidden');
    $('#image-wrapper button').addClass('hidden');

});