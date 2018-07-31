

$(document).on('click', '.modal-trigger', function () {
     
    let video_path = $(this).attr('video');

    let iframe = $('#video-modal iframe');

    iframe.attr('src', video_path);

    $('#video-modal').modal('show')

});

$('#video-modal').on('hidden.bs.modal', function (e) {
    
    let iframe = $('#video-modal iframe');

    iframe.attr('src', '');
});