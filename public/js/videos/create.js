Sortable.create(videos, {
    animation: 100,
    handle: '.handler',
    ghostClass: 'active'
});

$('input[type=file]').on('change', function () {

    readURL(this);

    $('.btn-submit').removeAttr('disabled');
});


function readURL(input) {

    $('.card-body #videos').empty();

    if (input.files) {

        let videos = input.files;

        for (const video in videos) {

            if (videos.hasOwnProperty(video)) {

                const element = videos[video];

                addNewVideo(element);
            }
        }
    }

    $('input.title').first().focus().blur();


}

let video = 0;

addNewVideo = function (element) {

    if (video === 1) {

        $('.card-header').removeClass('d-none');
    }

    let index = element.name.lastIndexOf(".");

    let title = element.name.slice(0, index);

    let template = `
         <div class="grid videos">
        
            <div class="form-group">
                <input type="text" class="form-control title" name="videos[${video}][title]" value="${title}">
                <input class="name" type="hidden" name="videos[${video}][original_name]" value="${element.name}">
            </div>
    
            <div class="switch">
                <label>
                    Paid
                    <input class="free" type="checkbox" name="videos[${video}][free]">
                    <span class="lever"></span>
                    Free
                </label>
            </div>

            <div class="icons"> 
                <i class="fas fa-sort handler"></i>
                <i class="fas fa-minus delete"></i>
                <i class="fas status"></i>
            </div>
        </div>

    `;

    $('.card-body #videos').append(template);

    Sortable.create(videos, {
        group: 'videos',
        animation: 100
    });

    video++;
}

const refreshTitles = function () {

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

    $(this).parents('.grid').remove();

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

    form.find('.btn-submit').attr('disabled', 'disabled');

    form.find('input').attr('disabled', 'disabled');

    loadingIcon(form);

    prepareDate();

});

const prepareDate = function () {

    videosNum--;

    let data = new FormData();

    currentEl = $('.videos').first();

    currentEl.removeClass('videos');

    let titleEl = $('input.title').first();

    titleEl.removeClass('title');

    let title = titleEl.val();

    let nameEl = $('input.name').first();

    nameEl.removeClass('name');

    let name = nameEl.val();

    let freeEl = $('input.free').first();

    freeEl.removeClass('free');

    let free = freeEl.is(':checked');

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
    } else {

        data.append('video', video);

        data.append('title', title);

        data.append('name', name);

        data.append('free', free);

    }
    storeVideo(data);

}

const storeVideo = function (data) {

    while (data == null && videosNum >= 0) {

        currentEl.find('.icons').html('<i class="fas fa-times text-danger"></i>')

        data = prepareDate();
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

    } else {

        window.location = response.redirect;
    }
}

const errorCallback = function () {

    currentEl.find('.icons').html('<i class="fas fa-times"></i>');

    $('.progress').remove();

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