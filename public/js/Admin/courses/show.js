$('input[type=file]').on('change', function () {

    readFiles(this);

});

function readFiles(input) {

    if (input.files) {

        let video = input.files[0];

        if (isVideo(video.name)) {

            $('#overview input[name="name"]').val(video.name);

            videoEl.preload = 'metadata';

            videoEl.src = URL.createObjectURL(video);

            videoEl.onloadedmetadata = function () {

                window.URL.revokeObjectURL(videoEl.src);

                let duration = calculateDuration(videoEl.duration);

                $('#overview input[name="duration"]').val(duration);

            }

        } else {

            toastr.error('File extension is not valid');
        }
    }
}


$('#overview form').on('submit', function (e) {

    e.preventDefault();

    submitFileForm(this, posterUpload);

});

let posterUpload = response => {

    let video = response.video;

    let action = video.poster_update_route;
    
    $(videoEl).attr('src', video.path);

    videoEl.load();

    posterUpdate = true;

    videoEl.onloadedmetadata = function () {

        this.currentTime = 5;
    }

    videoEl.onseeked = function () {

        let poster = captureImage(this);

        $.ajax({
            type: "PUT",
            url: action,
            data: {poster},
            success: function (response) {
                videoEl.remove;
            }
        });
    }
}