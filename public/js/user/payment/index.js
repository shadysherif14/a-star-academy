let $month = $('input#card-month');

let $type = $('input[name="type"]');

let $price = $('#video-price');

/** Type Validation */
$type.on('change', function () {

    let $checked = $('input[name="type"]:checked')

    let price = $checked.attr('price');

    $price.text(`${price} EGP`);

    $('#price-wrapper').fadeIn('slow');
});


let $form = $('#payment-form form');

$form.on('submit', function (e) {

    e.preventDefault();

    submitForm($form, subscriptionCallback);
});

const subscriptionCallback = response => {

    let iframe = `<iframe src="${response.iframe}"></iframe>`;

    $('#payment-form .modal-body').html(iframe);
    
    $('#payment-form').addClass('iframe-loaded');


}