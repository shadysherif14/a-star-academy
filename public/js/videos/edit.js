$('input[type=file]').on('change', function () {

    let changed = $('input[name="path_changed"]');
    
    changed.attr('checked', true);
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