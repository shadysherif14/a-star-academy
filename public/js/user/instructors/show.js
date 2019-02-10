$(function () {

    new WOW().init();
});

Array.prototype.randomElement = function () {

    let random = Math.random();

    if (random == 1) return this[this.length];

    return this[Math.floor(random * this.length)]
}

let $sliderContainer = $('#videos-slider');

let $slider = $sliderContainer.find('.carousel');

let $controlButtons = $sliderContainer.find('button.controls');

let $indicatorButtons = $sliderContainer.find('span.indicator');

$controlButtons.click(function () {

    $slider.carousel($(this).attr('control'));

});

$indicatorButtons.click(function () {

    $slider.carousel(parseInt($(this).attr('slide')));

});

$slider.on('slide.bs.carousel', function (e) {

    $(`.indicator[slide="${e.from}"]`).removeClass('active');

    $(`.indicator[slide="${e.to}"]`).addClass('active');

});


let displayedLayout = $('.layouts button.active').attr('layout');

$(function () {

    $('.layout').hide();

    $(`#videos-${displayedLayout}`).show();
});

let $layoutButtons = $('.layouts button.btn');

$layoutButtons.tooltip();

$layoutButtons.click(function () {

    let layout = $(this).attr('layout');

    $(this).addClass('active').siblings().removeClass('active');
    
    if (layout == displayedLayout) return;

    $(`#videos-${displayedLayout}`).fadeOut('slow', function () {

        $(`#videos-${layout}`).fadeIn('slow');

        displayedLayout = layout;

    });


});