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

$('.btn-file input').on('change', function () {

    let image = this.files ? this.files[0] : undefined;

    let $input = $(this).parent().next();

    image ? $input.val(image.name).fadeIn() : $input.val(null).fadeOut();

});

$('form').on('submit', function (e) {

    e.preventDefault();

    submitFileForm(this);
});


$('.tabs-nav').on('click', '.nav:not(.active)', function () {
   
    let $this = $(this);

    let target = $this.attr('target');

    let current = $this.siblings('.active').attr('target');

    let $currentTab = $(current);

    let $targetTab = $(target);

    $currentTab.animateCss('bounceOut', function () {
        
        $currentTab.hide();

        $targetTab.css('display', 'grid').animateCss('bounceIn');
    });
    
    $(this).addClass('active').siblings().removeClass('active');


});

