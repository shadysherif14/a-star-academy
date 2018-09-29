$('form.ajax').submit(function (e) {

    e.preventDefault();

    submitFileForm(this, successCallback, defaultError);
});

const successCallback = function (response) {

    $('video source').attr('src', response.video.path);
}