$('input[type=file]').on('change', function () {

    let changed = $('input[name="path_changed"]');

    changed.attr('checked', true);
});

$('form.ajax').submit(function (e) {

    e.preventDefault();

    submitFileForm(this, successCallback, defaultError);
});

const successCallback = function (response) {

    if (response.status) {

        $('i.fa-spin').remove();

        toastr.success('Video\'s data is successfully updated.');

        let changed = $('input[name="path_changed"]');

        if (changed.is(':checked')) {
            $('iframe').attr('src', response.path);
        }
    }
}