function CSRFToken() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

(function ($) {
    $.fn.serializeFormJSON = function () {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        if (o.hasOwnProperty('_token')) {
            let token = o['_token'];
            if (Array.isArray(token)) {
                o['_token'] = token[0];
            }
        }
        return o;
    };
})(jQuery);

function displayErrors(errors) {

    for (const error in errors) {

        let id = `error-${error}`;

        if (exists(id)) continue;

        let input = $(`[name="${error}"]`);

        input.next('small.feedback').remove();

        let type = input.attr('type');

        if (type === 'hidden') continue;

        let small = `<small class='font-weight-bold text-danger d-block feedback' id="${id}"> ${errors[error]} </small>`;

        if (type === 'checkbox' || type === 'radio') {

            let parent = $(`[parent=${error}]`);

            parent.append(small);

            continue;
        }
        input.after(small);
    }
}

$('input,textarea').keypress(function () {

    let name = $(this).attr('name');

    $(`#error-${name}`).remove();
});


const submitForm = function (form, successCallback, errorCallback) {

    let hiddenMethod = form.find('input[name="_method"]').val();

    let method = (hiddenMethod === undefined) ? form.attr('method') : hiddenMethod;

    let data = form.serializeFormJSON();

    let action = form.attr('action');

    if (!exists('loading-icon')) {

        let submitButton = form.find('.btn-submit');

        let loading = `<i class="ml-2 fas fa-circle-notch fa-spin" id="#loading-icon"></i>`;

        submitButton.append(loading);
    }

    $.ajax({
        type: method,
        url: action,
        data: data,
        success: successCallback,
        error: errorCallback
    });
}

const defaultSuccess = function (response) {
    if (response.status) {

        window.location = response.redirect;
    }
}

const defaultError = function (response, status, err) {
    let errors = response.responseJSON.errors;

    displayErrors(errors);
}

const exists = function (id) {
    return $(`#${id}`).length > 0;
}