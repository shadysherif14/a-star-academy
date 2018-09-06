function CSRFToken() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

function displayErrors(errors) {

    for (const error in errors) {

        let id = `error-${error}`;

        if (exists('#' + id)) continue;

        let input = $(`[name="${error}"]`);

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

$('input, textarea').attr('autocomplete', 'off');

$('input, textarea').focus(function () {

    let name = $(this).attr('name');

    //if (name.includes('[]')) return;

    let error = `#error-${name}`;
    
    $(error).remove();
});

$(document).on('change', 'select, input[type=radio], input[type=checkbox]', function () {

    let name = $(this).attr('name');

    $(`#error-${name}`).remove();
});

let currentForm;

const submitForm = function (form, successCallback, errorCallback) {

    currentForm = form;

    let hiddenMethod = form.find('input[name="_method"]').val();

    let method = (hiddenMethod === undefined) ? form.attr('method') : hiddenMethod;

    let data = form.serializeFormJSON();

    let action = form.attr('action');

    if (method.toUpperCase() !== 'GET') {
        CSRFToken();
    }

    $.ajax({
        type: method,
        url: action,
        data: data,
        success: successCallback,
        error: errorCallback
    });
}

const submitFileForm = function (form, successCallback, errorCallback) {

    let formEl = $(form);

    currentForm = formEl;

    let hiddenMethod = formEl.find('input[name="_method"]').val();

    let method = (hiddenMethod === undefined) ? formEl.attr('method') : hiddenMethod;

    let data = new FormData(form);

    let action = formEl.attr('action');

    loadingIcon(formEl);

    if (method.toUpperCase() !== 'GET') {
        CSRFToken();
    }
    
    if (method.toUpperCase() === 'PUT') {
        method = 'POST'
    }

    
    $.ajax({
        type: method,
        url: action,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: successCallback,
        error: errorCallback,
    });
}

const defaultSuccess = function (response) {

    if (response.status) {

        window.location = response.redirect;
    }
}

const defaultError = function (response, status, err, form) {

    let errors = response.responseJSON.errors;

    currentForm.animateCss('shake');

    displayErrors(errors);
}

const exists = function (selector) {
    return $(selector).length > 0;
}


$(document).on('click', '.btn.delete', function () {

    let action = $(this).attr('action');

    let method = 'DELETE';

    let btn = $(this);

    swal({
        title: 'Are you sure?',
        text: "Once deleted, you will not be able to recover it!",
        type: "warning",
        customClass: 'swal-delete',
        background: "#222",
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Keep',
        confirmButtonColor: '#CF000F',
        cancelButtonColor: '#f3b715',
        focusCancel: true
    }).then(result => {

        if (result.value) {

            CSRFToken();

            $.ajax({
                type: method,
                url: action,
                success: function (response) {
                    if (response.status) {

                        btn.parents('.grid').remove();
                    }
                }
            });
        }
    });
});

const loadingIcon = function (form) {

    /* if (exists('#loading-icon')) return;

    let submitButton = form.find('.btn-submit');

    let loading = `<i class="ml-2 fas fa-circle-notch fa-spin" id="loading-icon"></i>`;

    submitButton.append(loading); */
}

const showFormData = function (formData) {

    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }
}