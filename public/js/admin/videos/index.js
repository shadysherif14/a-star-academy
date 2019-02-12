
Sortable.create(videos, {
    animation: 100,
    handle: '.handler',
    ghostClass: 'active'
});

$(document).on('click', '.modal-trigger', function () {
     
    let video_path = $(this).parents('tr').attr('video');
    
    let iframe = $('#video-modal iframe');

    iframe.attr('src', video_path);

    $('#video-modal').modal('show');

});


$('#video-modal').on('hidden.bs.modal', function (e) {
    
    let iframe = $('#video-modal iframe');

    iframe.attr('src', '');
});

$('form#videos-form').submit(function (e) {

    e.preventDefault();

    let form = $(this);

    submitForm(form);
});

