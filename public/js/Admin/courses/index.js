$('#filter-modal .mdb-select').change(function () {

    let select = $(this);

    let value = select.val();

    if (value === undefined || value.trim() === '') {

        select.removeAttr('name');

        return;
    }

    let name = select.attr('name');

    if (name != undefined && name.trim() != '') return;

    let hiddenName = select.attr('hidden_name');

    select.attr('name', hiddenName);

});