// Data Picker Initialization
$('[datepicker]').pickadate();

// SideNav Button Initialization
$('.button-collapse').sideNav({

});
// SideNav Scrollbar Initialization
/* var sideNavScrollbar = document.querySelector('.custom-scrollbar');
Ps.initialize(sideNavScrollbar); */


$('.courses').owlCarousel({
    loop: true,
    margin: 50,
    nav: true,
    items: 3,
    animateOut: 'fadeOut',
    stagePadding: 30,
    smartSpeed: 450,
    autoWidth: true,

    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 2
        },
        992: {
            items: 3
        }

    }
});