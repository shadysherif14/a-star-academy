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