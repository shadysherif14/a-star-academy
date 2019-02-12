$('form.ajax').submit(function (e) {

    e.preventDefault();

    submitFileForm(this, successCallback, defaultError);

});

const successCallback = function (response) {
    
    if (response.status) {

        window.location = response.redirect;
    }
}

$('input[type=file]').on('change', function () {

    $('input[name="removed"]').val(false);

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
    
    $('input[name="removed"]').val(true);

    $('input[type=file]').val(null);

    $('.file-path').val(null);
    
    $('#image-wrapper img').attr('src', null).addClass('hidden');
    
    $('#image-wrapper button').addClass('hidden');
});