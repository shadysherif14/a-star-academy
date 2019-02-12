const sessionVideoEl = document.querySelector('#video');
const player = new Plyr('#video');

const captureImage = function (videoSrc) {

    var canvas = document.createElement("canvas");

    canvas.width = videoSrc.videoWidth;

    canvas.height = videoSrc.videoHeight;

    canvas.getContext('2d')
        .drawImage(videoSrc, 0, 0, canvas.width, canvas.height);

    if ('#poster-wrapper') {

        $('#poster-wrapper img').attr('src', canvas.toDataURL());
    }

    poster = canvas.toDataURL('image/jpeg');

    $("#video-poster").val(poster);

    return poster;
};

$('form').submit(function (e) {

    e.preventDefault();

    let $form = $(this);

    let duration = Math.round(player.duration);

    $("#video-duration").val(duration);
    if (duration == 0) {
        submitForm($form);
        return;        
    }

    sessionVideoEl.load();

    posterUpdate = true;

    sessionVideoEl.onloadedmetadata = function () {

        this.currentTime = 5;
    }

    sessionVideoEl.onseeked = function () {

        captureImage(this);

        submitForm($form);
    }

    // submitForm($form);

});

$('#videos-list').change(function () {
    let video = $(this).val();
    $("#video").removeClass('d-none').attr('src', `${path}/${video}`);
    $("#video-duration").val(player.duration);
});

$('#poster-btn').click(_ => captureImage(document.querySelector('#video')));