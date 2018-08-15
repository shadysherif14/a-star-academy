Sortable.create(videos, {
    animation: 100,
    handle: '.handler',
    ghostClass: 'active'
});

$(document).on('click', '.modal-trigger', function () {
     
    let video_path = $(this).parents('.grid').attr('video');
    
    let iframe = $('#video-modal iframe');

    iframe.attr('src', video_path);

    $('#video-modal').modal('show')

});


$('#video-modal').on('hidden.bs.modal', function (e) {
    
    let iframe = $('#video-modal iframe');

    iframe.attr('src', '');
});

$('form.ajax').submit(function (e) {

    e.preventDefault();

    let form = $(this);

    submitForm(form, successCallback, defaultError);
});

const successCallback = function (response) {
    if (response.status) {

        $('i.fa-spin').remove();

        toastr.success('Video\'s data is successfully updated.');
    }
}
