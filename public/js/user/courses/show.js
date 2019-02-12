$(function () {
    
    new WOW().init();

    $(".layout").hide();

    $(`#videos-${displayedLayout}`).show();

    if (sessionsNumber < 2) {
        
        $('#videos-slider .controls').prop('disabled', true);
    }
});

// Layout Change
let displayedLayout = $(".layouts button.active").attr("layout");

let $layoutButtons = $(".layouts button.btn");

$layoutButtons.tooltip();

$layoutButtons.click(function () {
    
    let layout = $(this).attr("layout");

    $(this).addClass("active").siblings().removeClass("active");

    if (layout == displayedLayout) return;

    $(`#videos-${displayedLayout}`).fadeOut("slow", function () {
        
        $(`#videos-${layout}`).fadeIn("slow");
        
        displayedLayout = layout;
    });
    
});


// Flippers Layout
$(".togglers i").on("click", function () {

    let $parent = $(this).closest(".content");

    let transform = $parent.css("transform");

    let degree = transform === "matrix(1, 0, 0, 1, 0, 0)" ? 180 : 0;

    $parent.css({
        transform: `rotateY(${degree}deg)`
    });

    $parent.find(".filppers").toggleClass("active");
});


// Slider Layout
$('button.controls').click(function () {
    
    let $slider = $(".sessions");

    let $currentSlide = getCurrentSlide($slider);
    
    let next = $(this).attr("control") == "next";

    let $newSlide = next ? $currentSlide.next(".session") : $currentSlide.prev(".session");

    $currentSlide.animateCss("bounceOut", () => {

        $currentSlide.removeClass("active");

        showSlide($newSlide);
        
    });

});

$('.navigation span.nav').click(function () {

    if ($(this).hasClass('active')) return;

    let $slider = $(".sessions");

    let $currentSlide = getCurrentSlide($slider);

    let $newSlide = $slider.find('.session').eq($(this).attr("slide"));

    $currentSlide.animateCss('bounceOut', () => {

        $currentSlide.removeClass("active");

        showSlide($newSlide);

    });

});

const getCurrentSlide = $slider => $slider.children(".active");

const showSlide = ($slide) => {

    let index = $slide.attr('slide');

    $('.navigation span.nav').eq(index).addClass('active').siblings().removeClass('active');

    let disabled = $slide.next().length === 0;
  
    $(".controls.next").prop("disabled", disabled);

    disabled = $slide.prev().length === 0;
  
    $(".controls.prev").prop("disabled", disabled);
  
    $slide.addClass("active").animateCss("bounceIn");
};
