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

    hours = hours < 10 ? '0' + hours : hours;

    let minutes = Math.floor(duration / 60);

    duration -= minutes * 60;

    minutes = minutes < 10 ? '0' + minutes : minutes;

    let seconds = Math.floor(duration);

    seconds = seconds < 10 ? '0' + seconds : seconds;

    return `${hours}:${minutes}:${seconds}`;

}


const captureFrame = _ => {

    videoEl.currentTime = 50;

    videoEl.play();

    videoEl.muted = true;

    var frame = captureVideoFrame(videoEl, 'png');

    // Show the image
    var img = document.getElementById('my-screenshot');
    
    img.setAttribute('src', frame.dataUri);
    
    return frame;

}

videoEl.addEventListener("seeked", function () {

    videoEl.play();

    var frame = captureVideoFrame(videoEl, 'png');

    // Show the image
    var img = document.getElementById('my-screenshot');

    img.setAttribute('src', frame.dataUri);

}, true);


