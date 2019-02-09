let video = null;

let sessionVideoEl = document.querySelector('video#session-video');

let poster = null;

let posterUpdate = false;

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

    if (poster) {

        data.append('poster', poster);
    }

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

    toastr.success("Data updated successfully.");

    if (response.videoChanged) {

        $('video#session-video source').attr('src', response.video.path);

        sessionVideoEl.load();

        posterUpdate = true;

        sessionVideoEl.onloadedmetadata = function () {

            this.currentTime = 5;
        }
    }

    video = null;

}

sessionVideoEl.onseeked = function () {

    if (posterUpdate) {

        captureImage(sessionVideoEl);

        $('form#poster-form input[name="poster"]').val(poster);

        $('form#poster-form').submit();

        posterUpdate = false;
    }
};

$('form#poster-form').submit(function (e) {

    e.preventDefault();

    submitForm($(this), posterSuccessCallback, defaultError);
});

const posterSuccessCallback = _ => {

    location.reload();

}

$('#poster-btn').click(_ => captureImage(document.querySelector('#session-video')));
