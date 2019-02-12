$(document).on('click', 'button.link', function () {
    window.location = $(this).attr('href');
});


$(document).ready(function () {

    //$('select').selectpicker('destroy');

    $('select').selectpicker({
        actionsBox: true,
        liveSearch: true,
        
    });

    $('select').addClass('show-tick');

    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
        $('select').selectpicker('mobile');
    }

    $('button').addClass('waves-effect waves-black');

    $('input[type="number"]').attr('min', 0);

    
});
// Refresh bootstrap select
const reInitializeSelect = selector => $(selector).selectpicker('refresh');

const refreshAllSelect = _ => reInitializeSelect('select');

autosize(document.querySelector('textarea'));