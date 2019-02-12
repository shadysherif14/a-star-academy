$(function () {

    Array.prototype.randomElement = function () {

        let random = Math.random();

        if (random == 1) return this[this.length];

        return this[Math.floor(random * this.length)]
    }

    Array.prototype.deleteElement = function (element) {

        let index = this.indexOf(element);

        if (index != -1) {

            this.splice(index, 1);
        }
    }

    changeProgressWidth(1);

    adaptiveHeight();

    $('.image-bg').each(function () {

        let $image = $(this);

        let $prev = $image.prev();

        let randomImage = images.randomElement();

        images.deleteElement(randomImage);

        $image.css({
            'min-height': $prev.height(),
            'background-image': `url(${randomImage})`
        });
    });



});

const player = new Plyr('#player');

let videoAlertMessage = true;

let counterIsRunning = timeRemaining ? true : false;

let subscriptionDuration = timeRemaining || player.duration * 1.5;

if (player) {
    player.on('playing', () => {

        if (videoAlertMessage && !isOverview && !timeRemaining) {
            player.pause();
            swal.fire({
                'type': 'info',
                'text': `Please notice that, if you start the video now you have only ${calculateDuration(subscriptionDuration)}, after that your subscription will be considered as invalid`,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: 'Start Now',
                cancelButtonText: 'Start Later',
            }).then((result) => {
                if (result.value) {
                    CSRFToken();
                    $.ajax({
                        type: 'PUT',
                        url: $('#subscription-route').val(),
                        data: {
                            seconds: subscriptionDuration
                        },
                        success: function (response) {
                            console.log(response);
                        }
                    });
                    videoAlertMessage = false;
                    player.play();
                    $('.floating-btn-left').text(calculateDuration(subscriptionDuration)).css('display', 'flex');
                    counterIsRunning = true;
                }
            });

        }
    });
}

const calculateDuration = duration => {

    let hours = Math.floor(duration / 3600);

    duration -= hours * 3600;

    hours = hours < 10 ? '0' + hours : hours;

    let minutes = Math.floor(duration / 60);

    duration -= minutes * 60;

    minutes = minutes < 10 ? '0' + minutes : minutes;

    let seconds = Math.floor(duration);

    seconds = seconds < 10 ? '0' + seconds : seconds;

    return `${hours}:${minutes}:${seconds}`;
}

setInterval(() => {

    if (!counterIsRunning) return;

    subscriptionDuration--;

    if (subscriptionDuration < 1) {
        location.reload()
    } else {
        $('.floating-btn-left').text(calculateDuration(subscriptionDuration)).css('display', 'flex');
    }


}, 1000);


let images = [

    'https://images.unsplash.com/photo-1533258439784-28006397342d?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=cbdcbe156f3bef6c67df859977b6a653&auto=format&fit=crop&w=400&q=80',

    'https://images.unsplash.com/photo-1508291167-c1f96536d450?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=c8a8d5a4fd19a0e4f5376272e31a1b4a&auto=format&fit=crop&w=889&q=80',

    'https://images.unsplash.com/photo-1524135329990-07660cd5bf10?ixlib=rb-0.3.5&s=216df38b57e36f11f05bf977b6ddbcd9&auto=format&fit=crop&w=401&q=80'
];

let $slider = $('#questions');

let $questionsProgress = $('#quiz .progress-bar');

let width = $(window).width();

$(window).on('resize', function () {

    if ($(this).width() == width) return;

    width = $(this).width();

    adaptiveHeight();
});


$slider.slick({
    swipe: false,
    infinite: false,
    vertical: true,
    prevArrow: $('#prev-question'),
    nextArrow: $('#next-question'),
});

const changeProgressWidth = index => {

    let width = index / questionsNumber * 100;

    $questionsProgress.css({
        'width': `${width}%`
    });
}


$slider.on('afterChange', function () {

    let index = $slider.slick('slickCurrentSlide') + 1;

    changeProgressWidth(index);

});


// Calculate the heighest slide and set a top/bottom margin for other children.
// As letiableHeight is not supported yet: https://github.com/kenwheeler/slick/issues/1803

const adaptiveHeight = () => {

    let maxHeight = -1;

    $('.slick-slide').each(function () {
        if ($(this).height() > maxHeight) {
            maxHeight = $(this).height();
        }
    });

    $('.slick-slide').each(function () {
        if ($(this).height() < maxHeight) {
            $(this).css('margin', Math.ceil((maxHeight - $(this).height()) / 2) + 'px 0');
        }
    });
}

$slider.on('wheel', function (e) {

    e.preventDefault();

    e.originalEvent.deltaY < 0 ? $slider.slick('slickPrev') : $slider.slick('slickNext');
});

$('form#quiz').submit(function (e) {

    e.preventDefault();

    submitForm($(this), quizSuccess, null);
});

const quizSuccess = response => {

    swal({
        title: 'You have completed the quiz!',
        text: `Your grade is ${response.correct} out of ${response.questions}.`,
        type: "info",
        background: "#222",
        showCancelButton: false,
        confirmButtonText: 'Ok',
    }).then(() => {

        /* $slider.slick('slickGoTo', 0);
    
        adaptiveHeight(); */
    });

}

setInterval(function () {

    let serial = $('input#user-serial').val();
    let username = $('input#user-name').val();

    if (!serial) return;

    let top = Math.round(Math.random() * 100);

    let template = `
        <div id="user-serial-overlay" style="top: ${top}% !important">
            <span> ${username} - ${serial} </span>
        </div>
    `;

    $('#user-serial-overlay').remove();

    $('.plyr').append(template);


}, 10000);

/*************************************** */

$(document).on('click', '.floating-btn', function () {

    if (!$(this).attr('data-user') || !$(this).attr('data-video')) {
        swal.fire({
            title: "Did you forgot to login?",
            type: 'error',
            html: `<p class="p-3 my-0">You have to be logged in to use this feature. <a href="/login" class="text-success">Login now</a></p><a href="/register" class="text-danger"><small> Don\'t have an account? Sign up now</small></a>`,
            showConfirmButton: false
        });
        return false;
    }
    swal.fire({
        title: "Question",
        type: 'question',
        input: 'textarea',
        text: 'Have a question about this session?',
        inputPlaceholder: 'Type your question here...',
        confirmButtonText: 'Send',
        showCancelButton: true
    }).then((result) => {
        let message = result.value;
        if (message) {
            CSRFToken()
            $.ajax({
                type: "POST",
                url: "/question",
                data: {
                    message: message,
                    video: $(this).attr('data-video')
                },
                success: function (response) {
                    swal.fire({
                        title: "Your Question Has Been Sent Successfully",
                        type: 'success',
                        text: 'The instructor has been notified. Thanks for reaching out, Happy learning',
                    });

                }
            });
        }

    })

});