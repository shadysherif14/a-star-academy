let schoolRadio = $('input[type=radio][name=school]')

let schoolLabels = $('#school label');

schoolLabels.on('click', function () {

    setTimeout(() => {

        let school = $('input[name=school]:checked').val();
    
        if (school === 'IGCSE') {
            
            $('#system').slideDown('slow').addClass('d-inline-flex');

            $('#sub_system').slideDown('slow').addClass('d-inline-flex');
        }
        else if (school === 'American Diploma') {

            $('#system').slideUp('slow').removeClass('d-inline-flex');

            $('#sub_system').slideUp('slow').removeClass('d-inline-flex');
        }
    }, 200);
});