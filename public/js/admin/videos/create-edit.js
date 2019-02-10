var priceElements = document.querySelectorAll('input.price');



let videoEl = document.querySelector('video#video');

const getExtension = file => {

    let parts = file.split('.');

    return parts[parts.length - 1];
}

function isVideo(filename) {

    let ext = getExtension(filename).toLowerCase();

    let videoExtensions = ['mp4', 'mov', 'ogg', 'qt', 'flv', 'mkv', 'avi', 'flv', 'mpg', 'mpeg'];

    return videoExtensions.includes(ext);
}

const calculateDuration = duration => {

    let hours = Math.floor(duration / 3600);

    duration -= hours * 3600;

    if (hours) {
        
        hours = hours < 10 ? '0' + hours : hours;

        hours += ':';

    } else {

        hours = '';
    }

    let minutes = Math.floor(duration / 60);

    duration -= minutes * 60;

    if (minutes) {
        
        minutes = minutes < 10 ? '0' + minutes : minutes;

        minutes += ':';

    } else {

        minutes = '';
    }

    let seconds = Math.floor(duration);

    seconds = seconds < 10 ? '0' + seconds : seconds;

    return `${hours}${minutes}${seconds}`;
}

let captureImage = function (videoSrc) {

    var canvas = document.createElement("canvas");

    canvas.width = videoSrc.videoWidth;

    canvas.height = videoSrc.videoHeight;

    canvas.getContext('2d')
        .drawImage(videoSrc, 0, 0, canvas.width, canvas.height);

    if ('#poster-wrapper') {

        $('#poster-wrapper img').attr('src', canvas.toDataURL());
    }

    poster = canvas.toDataURL('image/jpeg');

    return poster;
};