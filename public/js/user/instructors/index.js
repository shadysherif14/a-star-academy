$(function () {
    new WOW().init();
});

$('.togglers i').on('click', function () {

    let $parent = $(this).closest('.content');

    let transform = $parent.css('transform');
    
    let degree = transform === 'matrix(1, 0, 0, 1, 0, 0)' ? 180 : 0;

    $parent.css({
        transform: `rotateY(${degree}deg)`
    });

    $parent.find('.filppers').toggleClass('active');

});
