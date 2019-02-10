$(document).on('click', 'button.link', function () {
    window.location = $(this).attr('href');
});

function reInitializeSelect(selector) {
    $(selector).selectpicker('refresh');
}

function refreshAllSelect() {
    reInitializeSelect('select');
}

$(document).ready(function () {

    $('select').selectpicker({
        actionsBox: true,
        liveSearch: true,
    });

    $('select').addClass('show-tick');

    $('select').selectpicker('setStyle', 'bg-transparent');

    $('button').addClass('waves-effect waves-black');

    $('input[type="number"]').attr('min', 0);


});

autosize(document.querySelectorAll('textarea'));

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "4000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

$.fn.extend({
    animateCss: function (animationName, callback) {
        var animationEnd = (function (el) {
            var animations = {
                animation: 'animationend',
                OAnimation: 'oAnimationEnd',
                MozAnimation: 'mozAnimationEnd',
                WebkitAnimation: 'webkitAnimationEnd',
            };

            for (var t in animations) {
                if (el.style[t] !== undefined) {
                    return animations[t];
                }
            }
        })(document.createElement('div'));

        this.addClass('animated ' + animationName).one(animationEnd, function () {
            $(this).removeClass('animated ' + animationName);

            if (typeof callback === 'function') callback();
        });

        return this;
    },
});