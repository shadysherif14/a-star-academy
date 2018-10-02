let video = null;

$('input[type=file]').on('change', function () {

    let files = this.files;

    if (files.length) {

        video = isVideo(files[0].name) ? files[0] : null;

    }
});

$('form.ajax').submit(function (e) {

    e.preventDefault();

    let form = this;

    // Video doesn't change
    if (video === null) {

        formSubmit(form, successCallback, defaultError);

    } else {

        videoEl.preload = 'metadata';

        videoEl.src = URL.createObjectURL(video);

        videoEl.onloadedmetadata = function () {

            window.URL.revokeObjectURL(videoEl.src);

            let duration = calculateDuration(videoEl.duration);

            $('input#duration').val(duration);

            formSubmit(form, successCallback, defaultError);
        }
    }

});


const formSubmit = function (form, successCallback, errorCallback) {

    let formEl = $(form);

    let method = 'POST';

    let data = new FormData(form);

    let frame = captureFrame();

    let src = $('#my-screenshot').attr('src');
    
    console.log(src);
    
    data.append('snapshot', frame.dataUri);
   
    data.append('src', src);
   
    data.append('blob', frame.blob);

    let action = formEl.attr('action');

    $.ajax({
        type: method,
        url: action,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: successCallback,
        error: errorCallback,
    });
}

const successCallback = function (response) {

    $('video#session-video source').attr('src', response.video.path);

    document.querySelector('video#session-video').load();
}