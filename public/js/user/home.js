let timerInterval;
// In order to use this function you should declare a global variable
// See first line in this file
// EX: timerInterval
function showLoaderModal(title, body) {
    swal.fire({
        title: `${title}`,
        html: `${body}`,
        allowOutsideClick: false,
        allowEscapeKey: false,
        timer: 2000,
        onBeforeOpen: () => {
            swal.showLoading();
        },
        onClose: () => {
            clearInterval(timerInterval)
        }
    })
}

$('#contact-us-form').on('submit', function (e) {

    e.preventDefault();

    showLoaderModal('Sending your message...', 'This window will be closed automatically');
    
    submitForm($(this), successCallback, errorCallback);

});

const successCallback = (response) => {

    if (response.status) {
        swal.fire({
            'title': 'Thank you',
            'text': 'You message has been sent successfully.',
            'type': 'success'
        });

        $('#contact-us-form').find(':input').val(null);
    } else {
        swal.fire({
            'title': 'Sorry',
            'text': 'Something went wrong, please try again.',
            'type': 'error'
        });
    }
    clearInterval(timerInterval)
}


const errorCallback = function (response, status, err, form) {

    clearInterval(timerInterval);
    
    if (response.responseJSON) {

        let errors = response.responseJSON.errors;

        if (errors) {
            displayErrors(errors);
        }

    }
    
}