$('#contact-us-form').on('submit', function (e) {

    e.preventDefault();

    submitForm($(this), successCallback);
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
}