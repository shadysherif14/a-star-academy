
$('.logout-btn').on('click', () => document.getElementById('logout-form').submit());

Array.prototype.randomElement = function () {
    
    let random = Math.random();

    if (random == 1) return this[this.length];

    return this[Math.floor(random * this.length)];
};

$(document).on('click', '.like', function () {

    let $this = $(this);

    let action = $this.attr('action');

    let imgSrc = $this.attr('src');

    CSRFToken();
    
    $.post(action,

        function () {

            let newImgSrc = imgSrc.includes('white') ? imgSrc.replace('white', 'red') : imgSrc.replace('red', 'white');

            $this.fadeOut('', function () {
               
                $this.attr('src', newImgSrc);
                
                $this.fadeIn('');
            });
        },
    );
});

let $navbarToggler = $('.user-navbar .toggler');

$navbarToggler.click(function () {
   
    let $this = $(this);

    $this.parent().siblings('.links').slideToggle();
});

$(window).resize(() => {

    let width = $(window).innerWidth();

    if (width >= 768) {
        $('.user-navbar .links').slideDown().show();
    }
    
});
