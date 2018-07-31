$(document).ready(function () {

    // Data Picker Initialization
    $('[datepicker]').pickadate();

    const player = new Plyr('.plyr');

    $(".button-collapse").sideNav();
    // SideNav Scrollbar Initialization
    var sideNavScrollbar = document.querySelector('.custom-scrollbar');
    Ps.initialize(sideNavScrollbar);

});
