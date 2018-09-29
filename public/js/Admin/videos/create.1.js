let videoEl = document.querySelector('video#video');
let currentEl;
let video = 0;
let successfullyUploaded = `
<div class="header">
    <h2 class="text-success"> Uploaded Successfully <i class="fas fa-check"></i> </h2>
</div>
`;

let failedUploaded = `
<div class="header">
    <h2 class="text-danger" Upload Failed <i class="fas fa-times"></i>  </h2>
</div>
`;

/** Input file event listener */
$('input[type=file]').on('change', function () {

    readURL(this);

    $('.btn-submit').removeAttr('disabled');

});

const getExtension = file => {

    let parts = file.split('.');

    return parts[parts.length - 1];
}

function isVideo(filename) {

    let ext = getExtension(filename).toLowerCase();

    let videoExtensions = ['mp4', 'mov', 'ogg', 'qt', 'flv', 'mkv', 'avi', 'flv', 'mpg', 'mpeg'];

    return videoExtensions.includes(ext);

}

function readURL(input) {

    let invalid = false;

    $('#videos').empty();

    if (input.files) {

        let videos = input.files;

        for (const video in videos) {

            if (videos.hasOwnProperty(video)) {

                const element = videos[video];

                if (isVideo(element.name)) {

                    addNewVideo(element);
                } else {
                    invalid = true;
                }
            }
        }
    }

    if (invalid) {
        toastr.error('File extension is not valid');
    }

}

const addNewVideo = function (element) {

    let index = element.name.lastIndexOf(".");

    let title = element.name.slice(0, index);

    let template = `
        <div class="col-md-6 videos" id="videos-${video}">
        
            <div class="card">

                <div class="body">

                    <div class="form-group">
                        <label> Title </label>
                        <input type="text" placeholder="Title" class="form-control title" name="videos[${video}][title]" value="${title}">
                        <input class="name" type="hidden" name="videos[${video}][original_name]" value="${element.name}">
                    </div>

                    <div class="form-group">
                        <label> Price </label>
                        <input type="number" placeholder="Price" class="form-control price" name="videos[${video}][price]">
                    </div>

                    <div class="form-group">
                        <label> Description </label>
                        <textarea rows="2" name="videos[${video}][description]" class="form-control description" placeholder="Description"></textarea>
                    </div>
                    
                    
                    <div class="row justify-content-center buttons">

                        <button type="button" class="btn bg-primary upload" href="#videos-${video}">
                            <i class="zmdi zmdi-upload"></i> 
                            Upload
                        </button>

                        <button type="button"class="btn bg-red remove" href="#videos-${video}">
                            <i class="zmdi zmdi-delete"></i> 
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;

    $('#videos').append(template);

    autosize($('textarea'));

    video++;
}

$(document).on('click', '.remove', function () {

    let target = $(this).attr('href');

    $(target).remove();
});

$(document).on('click', '.upload', function () {

    let target = $(this).attr('href');

    $(target).waitMe({
        effect: 'pulse',
        text: 'Session is uploading',
    });

    let data = new FormData();

    currentEl = $(target);

    /** Title */
    let title = currentEl.find('input.title').val();

    /** Description */
    let description = currentEl.find('textarea.description').val();

    /** Name */
    let name = currentEl.find('input.name').val();

    /** Price */
    let price = currentEl.find('input.price').val();

    price = parseFloat(price);

    price = isNaN(price) ? 0 : price;

    /** Files */
    let files = document.querySelector('#files').files;

    let video;

    for (const file in files) {

        if (files.hasOwnProperty(file)) {

            const element = files[file];

            if (element.name === name) {

                video = element;
            }
        }
    }

    if (video === undefined) {

        // Video doesn't exist

        return;
    }

    let duration = 0;

    videoEl.preload = 'metadata';

    videoEl.src = URL.createObjectURL(video);

    videoEl.onloadedmetadata = function () {

        window.URL.revokeObjectURL(videoEl.src);

        duration = videoEl.duration;

        let hours = Math.floor(duration / 3600);

        duration -= hours * 3600;

        hours = hours < 10 ? '0' + hours : hours;

        let minutes = Math.floor(duration / 60);

        duration -= minutes * 60;

        minutes = minutes < 10 ? '0' + minutes : minutes;

        let seconds = Math.floor(duration);

        seconds = seconds < 10 ? '0' + seconds : seconds;

        duration = `${hours}:${minutes}:${seconds}`;

        data.append('duration', duration);

        data.append('video', video);

        data.append('title', title);

        data.append('description', description);

        data.append('name', name);

        data.append('price', price);

        uploadVideo(data);
    }

});

const uploadVideo = data => {

    let form = $('#form');

    let action = form.attr('action');

    let method = form.attr('method');

    showFormData(data);

    CSRFToken();

    $.ajax({
        type: method,
        url: action,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: successCallback,
        error: errorCallback,
        xhr: xhrCallback
    });
}

let videosNum;

/* $('form.ajax').submit(function (e) {

    e.preventDefault();

    $('.upload').each(function () {

        setTimeout(function () {
            console.log($(this).attr('href'));
        }, 2000);
    });

    return;

    toastr.info('This may be take a while, so please be patient and don\'t close the page.');

    videosNum = childrenNumber('#videos');

    let form = $(this);

    form.find('.icons').empty();

    $('.status').text('Status');

    prepareData();

}); */

const prepareData = function () {

    videosNum--;

    if (videosNum < 0) return;

    let data = new FormData();

    currentEl = $('.videos').first();

    currentEl.removeClass('videos');

    /** Title */
    let titleEl = $('input.title').first();

    titleEl.removeClass('title');

    let title = titleEl.val();

    /** Description */
    let descriptionEl = $('textarea.description').first();

    descriptionEl.removeClass('description');

    let description = descriptionEl.val();

    /** Name */
    let nameEl = $('input.name').first();

    nameEl.removeClass('name');

    let name = nameEl.val();

    /** Price */
    let priceEl = $('input.price').first();

    priceEl.removeClass('price');

    let price = parseFloat(priceEl.val());

    price = isNaN(price) ? 0 : price;

    /** Files */
    let files = document.querySelector('#files').files;

    let video;

    for (const file in files) {

        if (files.hasOwnProperty(file)) {

            const element = files[file];

            if (element.name === name) {

                video = element;
            }

        }
    }

    if (video === undefined) {

        data = null;

        storeVideo(data);


    } else {

        let duration = 0;

        let videoEl = document.querySelector('video#video');

        videoEl.preload = 'metadata';

        videoEl.src = URL.createObjectURL(video);

        videoEl.onloadedmetadata = function () {

            window.URL.revokeObjectURL(videoEl.src);

            duration = videoEl.duration;

            let hours = Math.floor(duration / 3600);

            duration -= hours * 3600;

            hours = hours < 10 ? '0' + hours : hours;

            let minutes = Math.floor(duration / 60);

            duration -= minutes * 60;

            minutes = minutes < 10 ? '0' + minutes : minutes;

            let seconds = Math.floor(duration);

            seconds = seconds < 10 ? '0' + seconds : seconds;

            duration = `${hours}:${minutes}:${seconds}`;

            data.append('duration', duration);

            storeVideo(data);
        }

        data.append('video', video);

        data.append('title', title);

        data.append('description', description);

        data.append('name', name);

        data.append('price', price);
    }


}

const storeVideo = function (data) {

    while (data == null && videosNum >= 0) {

        currentEl.find('.icons').html('<i class="fas fa-times text-danger"></i>')

        data = prepareData();
    }

    if (data == null) {
        return;
    }

    let progress = `
            <div class="progress md-progress w-50 mx-auto">
                <div id="progress" class="progress-bar elegant-color-dark progress-bar-striped progress-bar-animated" role="progressbar"
                    style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
    `;

    currentEl.after(progress);

    let form = $('#form');

    let action = form.attr('action');

    let method = form.attr('method');

    CSRFToken();

    $.ajax({
        type: method,
        url: action,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: successCallback,
        error: errorCallback,
        xhr: xhrCallback
    });
}

const successCallback = function (response) {

    currentEl.find('.card').prepend(successfullyUploaded);

    currentEl.find('input, textarea').prop('disabled', true);

    currentEl.find('buttons').remove();

    currentEl.waitMe('hide');
}

const errorCallback = function () {

    currentEl.find('.icons').html('<i class="fas fa-times"></i>');

    $('.progress').remove();

    if (videosNum === 0) {

        let form = $('form');

        form.find('.btn-submit').removeAttr('disabled');

        form.find('input').removeAttr('disabled');

    } else {

        prepareData();
    }

}

const xhrCallback = function () {

    let loaded = 0;

    let myXhr = $.ajaxSettings.xhr();

    if (myXhr.upload) {
        // For handling the progress of the upload
        myXhr.upload.addEventListener('progress', function (e) {

            if (e.lengthComputable) {

                loaded = Math.round(e.loaded / e.total * 100);

                let percentage = `${loaded}%`;

                let progressEl = $('#progress');

                progressEl.attr('aria-valuenow', loaded);

                progressEl.css('width', percentage);

                progressEl.text(percentage);
            }
        }, false);
    }
    return myXhr;
}

const childrenNumber = selector => $(selector).children().length;