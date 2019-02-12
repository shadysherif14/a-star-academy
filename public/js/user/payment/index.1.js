let $name = $('input#card-name');

let $number = $('input#card-number');

let $cardImage = $('#card-image img');

let $date = $('input#card-date');

let $year = $('input#card-year');

let $month = $('input#card-month');

let $type = $('input[name="type"]');

let $price = $('#video-price');

let $cv = $('input#card-cv');

let cvLength = 3;

let validData = {
    number: false,
    name: false,
    type: false,
    year: false,
    month: false,
    cv: false,
}

// Masks
let numberMask = new IMask($number.get(0), {
    mask: '0000 0000 0000 0000'
});

let dateMask = new IMask($date.get(0), {
    mask: 'MM/YY',
    lazy: true,
    blocks: {
        YY: {
            mask: '00',
        },

        MM: {
            mask: IMask.MaskedRange,
            from: 1,
            to: 12
        },
    }
});

let cvMask = new IMask($cv.get(0), {
    mask: '000'
});
// Mask


/** Type Validation */
$type.on('change', function () {

    let $checked = $('input[name="type"]:checked')

    let price = $checked.attr('price');

    let value = $checked.val();

    $price.text(`${price} EGP`);

    $('#price-wrapper').fadeIn('slow');

    validKey('type');
});

/** Type Validation */

/** Name Validation */
$name.on('blur', function () {

    let name = $name.val();

    resetParentElement($name);

    if (name) {

        validInput($name);

        validKey('name');

        return;
    }

    invalidInput($name);

    invalidKey('name');

});
/** Name Validation */

/** Number Validation */
const validateNumber = event => {

    let type = null;

    let number = numberMask.unmaskedValue;

    $('#hidden-number').val(number);

    let numberValidation = valid.number(number);

    resetParentElement($number);

    if (numberValidation.isValid) {

        validKey('number');

        validInput($number);

        cvLength = numberValidation.card.code.size;

        mask = cvLength == 3 ? '000' : '0000';

        cvMask.updateOptions({
            mask
        });

    } else if (!numberValidation.isPotentiallyValid || event === 'blur') {

        invalidKey('number');

        invalidInput($number);

    }

    if (numberValidation.card) {
        type = numberValidation.card.type;        
    } else {
        type = null;
    }
    changeImage(type);
}

$number.on('blur', () => validateNumber('blur'));

$number.on('keyup', () => validateNumber('keyup'));

const changeImage = type => {

    let imageName = 'visa.png'

    switch (type) {

        case 'visa':
            imageName = 'visa.png';
            break;

        case 'mastercard':
            imageName = 'mastercard.png';
            break;

        case 'american-express':
            imageName = 'american-express.png';
            break;

        case 'diners-club':
            imageName = 'diners-club.png';
            break;

        case 'discover':
            imageName = 'discover.png';
            break;

        case 'jcb':
            imageName = 'jcb.png';
            break;

        case 'unionpay':
            imageName = 'unionpay.png';
            break;

        case 'maestro':
            imageName = 'maestro.png';
            break;

        case 'elo':
            imageName = 'elo.png';
            break;

        default:
            imageName = 'credit-card.png';
            break;
    }

    $cardImage.attr('src', `${paymentFolder}/${imageName}`);

}
/** Number Validation */


/** Date Validation */
$date.on('blur', function () {

    resetParentElement($date);

    let date = dateMask.value;

    let dateValidation = valid.expirationDate(date);

    if (!dateValidation.isValid) {

        invalidInput($date);

        invalidKey('year');

        invalidKey('month');

        return;
    }

    $year.val(dateValidation.year);

    $month.val(dateValidation.month);

    validKey('year');

    validKey('month');

    validInput($date);

});
/** Date Validation */

/** CV Validation */
$cv.on('blur', function () {

    resetParentElement($cv);

    let cv = cvMask.value;

    let cvValidation = valid.cvv(cv, cvLength);

    if (!cvValidation.isValid) {

        invalidInput($cv);

        invalidKey('cv');

        return;
    }

    validKey('cv');

    validInput($cv);

});
/** CV Validation */

const resetParentElement = $el => $el.parent().removeClass('has-danger has-success');

const validInput = $el => $el.parent().addClass('has-success');

const invalidInput = $el => $el.parent().addClass('has-danger');

const invalidKey = key => validData[key] = false;

const validKey = key => validData[key] = true;

let $form = $('#payment-form form');

$form.on('submit', function (e) {

    e.preventDefault();

    let valid = true;

    for (const key in validData) {

        if (!validData[key]) {

            valid = false;

            break;
        }
    }

    if (!valid) {

        toastr.error('You have invalid inputs!');

        //return;
    }

    submitForm($form, subscriptionCallback);
});

const subscriptionCallback = response => {

    // window.location.reload();
}