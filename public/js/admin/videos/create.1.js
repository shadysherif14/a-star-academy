let currentEl;

let video = 1;

let successfullyUploaded = `
<div class="header">
    <h2 class="text-success"> Uploaded Successfully <i class="fas fa-check"></i> </h2>
</div>
`;

let failedUploaded = `
<div class="header">
    <h2 class="text-danger"> Upload Failed <i class="fas fa-times"></i> </h2>
</div>
`;

/** Input file event listener */
$('input[type=file]').on('change', function () {

    let btnSubmit = $('button[type="submit"]');

    if (btnSubmit.hasClass('d-none')) {

        btnSubmit.removeClass('d-none').addClass('d-block').fadeIn('slow');
    }

    readFiles(this);

});

function readFiles(input) {

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

    let id = `videos-${video}`;

    let template = `
        <div class="col-md-6 videos" id="${id}">
        
            <div class="card">

                <div class="body">

                    <div class="form-group">
                        <label> Title </label>
                        <input type="text" placeholder="Title" id="${id}-name" class="form-control title" value="${title}">
                        <input class="name" type="hidden" value="${element.name}">
                    </div>

                    
                    <div class="form-group">
                        <label> Price </label>
                        <div class="row">
                        
                            <div class="input-group col-md-6">
                                <span class="input-group-addon">
                                    <i class="fas fa-infinity"></i>
                                </span>
                                <input type="text" id="${id}-unlimited-price" class="form-control price unlimited"
                                placeholder="Unlimited access">
                            </div>

                            <div class="input-group col-md-6">
                                <span class="input-group-addon">
                                    <i class="zmdi zmdi-collection-item-1"></i>
                                </span>
                                <input type="text" id="${id}-one-price" class="form-control price one" placeholder="One time access">
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label> Description </label>
                        <textarea class="form-control description" id="${id}-description" placeholder="Description"></textarea>
                    </div>
                    
                    <div class="row justify-content-center buttons">

                        <button type="button" class="btn bg-primary upload" href="#${id}">
                            <i class="zmdi zmdi-upload"></i> 
                            Upload
                        </button>

                        <button type="button"class="btn bg-red remove" href="#${id}">
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

    let unlimitedGlobalPrice = $('#unlimited-price').val();

    unlimitedGlobalPrice = unlimitedGlobalPrice ? unlimitedGlobalPrice : 0;

    let oneGlobalPrice = $('#one-price').val();

    oneGlobalPrice = oneGlobalPrice ? oneGlobalPrice : 0;
    
    let target = $(this).attr('href');

    $(target).waitMe({
        effect: 'pulse',
        text: 'Session is uploading',
    });

    let data = new FormData();

    /** Title */
    let title = $(target).find('input.title').val();

    /** Description */
    let description = $(target).find('textarea.description').val();

    /** Name */
    let name = $(target).find('input.name').val();

    /** Price */
    let unlimited_price = $(target).find('input.unlimited').val();

    unlimited_price = unlimited_price ? unlimited_price : unlimitedGlobalPrice;

    let one_price = $(target).find('input.one').val();

    one_price = one_price ? one_price : oneGlobalPrice;

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

    if (video === undefined) return;

    videoEl.preload = 'metadata';

    videoEl.src = URL.createObjectURL(video);

    videoEl.onloadedmetadata = function () {

        window.URL.revokeObjectURL(videoEl.src);

        let duration = calculateDuration(videoEl.duration);

        data.append('duration', duration);

        data.append('video', video);

        data.append('title', title);

        data.append('description', description);

        data.append('name', name);

        data.append('unlimited_price', unlimited_price);

        data.append('one_price', one_price);

        data.append('target', target);

        uploadVideo(data);
    }

});

const uploadVideo = data => {

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

    let sessionID = response.target;

    let sessionEl = $(sessionID);

    let video = response.video;

    sessionEl.find('.header').remove();

    sessionEl.find('.card').prepend(successfullyUploaded);

    let uploadVideoID = `uploaded-video-${video.id}`;

    let template = `

    <div id="${uploadVideoID}">
        <div class="table-responsive">
            <table class="table table-hover m-t-20">
                <tbody>
                    <tr>
                        <td> Title </td>
                        <td> ${video.title} </td>
                    </tr>

                    <tr>
                        <td> <i class="fas fa-infinity"></i> Price </td>
                        <td> ${video.unlimited_price} EGP </td>
                    </tr>

                    <tr>
                        <td> <i class="zmdi zmdi-collection-item-1"></i> Price </td>
                        <td> ${video.one_price} EGP </td>
                    </tr>

                    <tr>
                        <td> Description </td>
                        <td> ${video.description || ''} </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row justify-content-center buttons">

            <button type="button" class="btn link bg-primary" href="${video.admin_routes.edit}">
                <i class="zmdi zmdi-edit"></i> 
                Edit
            </button>

            <button type="button"class="btn bg-red delete" action="${video.admin_routes.destroy}" target="${sessionID}">
                <i class="zmdi zmdi-delete"></i> 
                Delete
            </button>

        </div>

        <video class="d-none" id="video-el-${video.id}" src="${video.path}"></video>
        
    </div>
   
    `;

    sessionEl.find('.body').html(template);

    sessionEl.waitMe('hide');

    uploadPoster(`video-el-${video.id}`, video.poster_update_route);

}

const uploadPoster = (videoID, action) => {

    let sessionVideoEl = document.querySelector(`#${videoID}`);

    sessionVideoEl.load();

    posterUpdate = true;

    sessionVideoEl.onloadedmetadata = function () {

        this.currentTime = 5;
    }

    sessionVideoEl.onseeked = function () {

        let poster = captureImage(this);

        $.ajax({
            type: "PUT",
            url: action,
            data: {
                poster
            },
            success: function (response) {
                sessionVideoEl.remove;
            }
        });
    }

}

$('form.ajax').submit(function (e) {

    e.preventDefault();

    $uploadBtns = $('button.upload');

    let time = 2000;

    $uploadBtns.each(function (index) {

        setTimeout(() => {

            $(this).click();
        }, time);

        time += 2000;

    });
});

const errorCallback = response => {

    let errors = response.responseJSON.errors;

    let id = errors.target[0];

    let sessionEl = $(id);

    sessionEl.find('.header').remove();

    sessionEl.find('.card').prepend(failedUploaded);

    sessionEl.waitMe('hide');

    id = id.replace('#', '');

    let array = ['title', 'price', 'description'];

    array.forEach(element => {

        let errorID = `error-${id}-${element}`;

        let error = errors[element];

        if (error === undefined || exists('#' + errorID)) return;

        let input = sessionEl.find(`.${element}`);

        let small = `<small class='text-danger feedback' id="${errorID}"> ${error} </small>`;

        input.after(small);
    });
}

const xhrCallback = function () {

    let loaded = 0;

    let myXhr = $.ajaxSettings.xhr();

    if (myXhr.upload) {
        // For handling the progress of the upload
        myXhr.upload.addEventListener('progress', function (e) {

            if (e.lengthComputable) {

                loaded = Math.round(e.loaded / e.total * 100);
                
                console.log(loaded);
                
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