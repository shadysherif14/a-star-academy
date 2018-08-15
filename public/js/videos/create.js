Sortable.create(videos, {
    animation: 100,
    handle: '.handler',
    ghostClass: 'active'
});


$('input[type=file]').on('change', function () {

    readURL(this);
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

        $('.file-path').val(null);

        refreshTitles();
    }


}

let video = 0;

addNewVideo = function (element) {

    if (video === 1) {

        $('.card-header').removeClass('d-none');
    }

    let index = element.name.lastIndexOf(".");

    let title = element.name.slice(0, index);

    let template = `
         <div class="grid">
        
            <div class="form-group">
                <input type="text" class="form-control title" name="videos[${video}][title]" value="${title}">
                <input type="text" name="videos[${video}][original_name]" class="d-none" value="${element.name}">
            </div>
    
            <div class="switch">
                <label>
                    Paid
                    <input type="checkbox" name="videos[${video}][free]">
                    <span class="lever"></span>
                    Free
                </label>
            </div>
    
            <div class="icons"> 
                <i class="fas fa-bars handler"></i>
                <i class="fas fa-minus delete"></i>
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

/* $('form.ajax').submit(function (e) {

    e.preventDefault();

    let form = $(this);

    toastr.info('This may be take awhile, so please pa patient and don\'t close this page.');

    submitForm(form, successCallback, defaultError);
});

const successCallback = function (response) {

    if (response.status) {

        toastr.success('videos has been successfully updated, you can now upload more videos');
    }
}

$(function () {
    $('#fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo(document.body);
            });
        }
    });
}); */