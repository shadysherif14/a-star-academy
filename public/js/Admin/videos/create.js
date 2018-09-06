/* Sortable.create(videos, {
    animation: 100,
    handle: '.handler',
    ghostClass: 'active'
});
 */
$('input[type=file]').on('change', function () {

    readURL(this)

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

    $('.card-body #videos').empty();

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

let video = 0;

const addNewVideo = function (element) {

    if (video === 1) {

        $('.card-header').removeClass('d-none');
    }

    let index = element.name.lastIndexOf(".");

    let title = element.name.slice(0, index);

    let template = `
        <div class="videos">

            <div class="grid">
        
                <div class="form-group">
                    <input type="text" placeholder="Title" class="form-control title" name="videos[${video}][title]" value="${title}">
                    <input class="name" type="hidden" name="videos[${video}][original_name]" value="${element.name}">
                </div>

                <div class="form-group">
                    <input type="number" placeholder="Price" class="form-control price" name="videos[${video}][price]">
                </div>

                <div class="icons"> 
                    <i class="fas fa-minus delete"></i>
                    <i class="fas status"></i>
                </div>

            </div>
            <div class="form-group textarea-container">
                <textarea rows="2" name="videos[${video}][description]" class="form-control description" placeholder="Description"></textarea>
            </div>
        </div>

    `;

    $('.card-body #videos').append(template);

    autosize($('textarea'));

    Sortable.create(videos, {
        group: 'videos',
        animation: 100
    });

    video++;
}

const refreshTitles = _ => {

    let titleInputs = $('input.title');

    let titles = ``;

    titleInputs.each(function (index) {

        if (index == 0)
            titles += $(this).val();

        else {
            titles += ', ' + $(this).val();
        }
    })

    $('.file-path').val(titles);
}

$(document).on('blur', '.title', _ => refreshTitles());

$(document).on('click', '.delete', function () {

    $(this).parents('.videos').remove();

    refreshTitles();
});


let videosNum;

let currentEl;


$('form.ajax').submit(function (e) {

    e.preventDefault();

    toastr.info('This may be take a while, so please be patient and don\'t close the page.');

    videosNum = childrenNumber('#videos');

    let form = $(this);

    form.find('.icons').empty();

    $('.status').text('Status');

    prepareData();

});

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

    if (videosNum > 0) {

        if (response.status) {

            currentEl.find('.icons').html('<i class="fas fa-check"></i>');

        } else {
            currentEl.find('.icons').html('<i class="fas fa-times"></i>');
        }

        $('.progress').remove();

        prepareData();

    } else {

        if (response.redirect)
            window.location = response.redirect;
    }
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