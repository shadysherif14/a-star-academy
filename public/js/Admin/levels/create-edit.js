if (level.length != 0) {

    let schoolRadio = $(`input[name="school"][value="${level.school}"]`);

    schoolRadio.attr('checked', 'checked');

    schoolRadio.parent('label').addClass('active');

} else {

    $('#image-wrapper img').attr('src', null).addClass('hidden');

    $('#image-wrapper button').addClass('hidden');
}

$('#add-school-btn').on('click', _ => {

    let newSchool = $('#new_school');

    let school = newSchool.val();
    
    if (school.length === 0) return;

    $('#school option').removeAttr('selected');

    let schoolExists = false;
    
    $('#school option').each(function () {
       
        let value = $(this).val();

        if (value.toUpperCase() === school.toUpperCase()) {
            
            $(this).prop('selected', true);

            schoolExists = true;

            return;
        } 
    });
    
    if (schoolExists === false) {
        
        let newOption = `<option value="${school}" selected> ${school} </option>`;

        $('#school').append(newOption);
    }
    
    reInitializeSelect('#school');

    newSchool.val(null).blur();
    
});