let payButton = $('.pay');

let formModal = $('#pay-modal');

payButton.on('click', function () {

    let action = $(this).attr('action');

  /*   $.ajax({
        type: "GET",
        url: action,
        success: function (response) {

            formModal.find('iframe').attr('src', response.iframeSrc);

            formModal.modal('show');
        }
    }); */
    let price = $(this).attr('price');

    formModal.attr('action', action);

    formModal.modal('show');

    let submitBtnHtml = `<i class='fas fa-money-check'></i> Pay ${price} L.E`;

    formModal.find('.btn-submit').html(submitBtnHtml);

    $('.card-wrapper').css('min-height', '0px');
});

new Card({

    form: '#pay-modal',

    container: '.card-wrapper',

    formSelectors: {
        numberInput: 'input[name="card_number"]',
        expiryInput: 'input[name="card_expiry_mm"], input[name="card_expiry_yy"]',
        cvcInput: 'input[name="card_cvn"]',
        nameInput: 'input[name="card_holdername"]'
    },

    placeholders: {
        number: '•••• •••• •••• ••••',
        name: 'Full Name',
        expiry: '••/••',
        cvc: '•••'
    },

});

formModal.submit(function (e) {

    e.preventDefault();

    let form = $(this);

    submitForm(form, paySuccessCallback, payErrorCallback);
});

const paySuccessCallback = function (response) {

    if (response.status) {

        swal({
            title: 'Success',
            type: 'success'
        })
    }
}

const payErrorCallback = function (response) {

    formModal.animateCss('shake');

    let errors = response.responseJSON.errors;

    displayErrors(errors);

    let status = response.responseJSON.status;

    if (status === false) {

        swal({
            title: 'Error',
            text: response.responseJSON.message,
            type: 'error'
        });
    }
}