let $type = $('input[name="type"]');

let $price = $('#video-price');

/** Type Validation */
$type.on('change', function () {

    let $checked = $('input[name="type"]:checked')

    let price = $checked.attr('price');

    $price.text(`${price} EGP`);

    $('#price-wrapper').fadeIn('slow');

});

let $form = $('#payment form');

$form.on('submit', function (e) {

    e.preventDefault();

    submitForm($form, iframeSuccess, iframeError);
});
const iframeSuccess = response => {
    
    $('#payment').modal('hide');
    
    $('#payment-form iframe').attr('src', response.iframe);
    
    $('#payment-form').modal('show');

}

const iframeError = response => {

    console.log(response);
}