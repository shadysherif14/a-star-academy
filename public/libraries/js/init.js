$(document).on('click', 'button.link', function () {
    window.location = $(this).attr('href');
});

const reInitializeSelect = selector => $(selector).selectpicker('refresh');

$(document).ready(function () {

    $('select').selectpicker({
        actionsBox: true,
        liveSearch: true,
    });

    $('select').addClass('show-tick');

    $('select').selectpicker('setStyle', 'bg-transparent');

    $('button').addClass('waves-effect waves-black');

    initDataTable('table');

    $('input[type="number"]').attr('min', 0);

});

let tableLength = $('.dataTables_length');

tableLength.find('')

let textareaElements = document.querySelectorAll('textarea');

autosize(textareaElements);

/* toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "4000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
} */


const
    sEmptyTable = "No data available in table",
    sInfo = "Showing _START_ to _END_ of _TOTAL_ entries",
    sInfoEmpty = "Showing 0 to 0 of 0 entries",
    sInfoFiltered = "(filtered from _MAX_ total entries)",
    sInfoPostFix = "",
    sInfoThousands = ",",
    sLengthMenu = "Show _MENU_ entries",
    sLoadingRecords = "Loading...",
    sProcessing = "Processing...",
    sSearch = "Search: ",
    sZeroRecords = "No matching records found",
    sFirst = "First",
    sLast = "Last",
    sNext = "Next",
    sPrevious = "Previous",
    sUrl = "",
    add = 'Add',
    print = 'Print',
    excel = 'Excel',
    pdf = 'PDF',
    cols = 'Columns',
    sDelete = 'Delete',
    m4 = "mr-4",
    m2 = "mr-2";

const initDataTable = (table) => {

    let addOptions = {};

    let displayAddBtn = addOptions.show ? $('.actions li a[data-action=0]').parents('li').show() : $('.actions li a[data-action=0]').parents('li').hide();


    let targetAddBtn = addOptions.target ? addOptions.target : '';

    var table = $(table).DataTable({
        dom: 'Blfrtip',
        dom: "<'row'<'col-sm-12'B>>" +
            "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

        colReorder: true,
        fixedHeader: true, // causes problem when scrolling
        searchHighlight: true,
        responsive: true,

        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

        language: {
            processing: sProcessing,
            search: sSearch,
            lengthMenu: sLengthMenu,
            info: sInfo,
            infoEmpty: sInfoEmpty,
            infoFiltered: sInfoFiltered,
            infoPostFix: sInfoPostFix,
            loadingRecords: sLoadingRecords,
            zeroRecords: sZeroRecords,
            emptyTable: sEmptyTable,
            paginate: {
                first: sFirst,
                previous: sPrevious,
                next: sNext,
                last: sLast
            },

        },
        // Order of buttons is IMPORTANT
        // 0 => Add 
        // 1 => Print 
        // 2 => Excel 
        // 3 => PDF 
        // 4 => Filter 
        buttons:
            
            [
            
            {
                text: `<i class="fa fa-plus ${m4}"></i>${add}`,
                className: `btn sbold green text-white px-3 ${displayAddBtn}`,
                action: function (e, dt, node, config) {
                    window.location.assign(`${targetAddBtn}`);
                }
            },
            {
                extend: 'print',
                text: `<i class="fa fa-print ${m4}"></i>${print}`,
                className: 'btn dark text-white',
                tag: 'a',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                text: `<i class="fa fa-file-excel-o ${m4}"></i>${excel}`,
                className: 'btn green-jungle text-white',
                tag: 'a'
            },

            {
                extend: 'pdf',
                text: `<i class="fa fa-file-pdf-o ${m4}"></i>${pdf}`,
                className: 'btn yellow-gold text-white',
                tag: 'a'
            },
            {
                extend: 'colvis',
                text: `<i class="fa fa-filter"></i>`,
                className: 'btn red text-white',
                tag: 'a'

            },
        ]
    });

    table.on('buttons-action', function (e, buttonApi, dataTable, node, config) {

        // Check if the clicked button is colvis btn [colvis button is the only button that has a _collection]
        if (config._collection) {

            let menu = config._collection;

            let targetTableId = $(this).attr('id');

            let el = $(`#${targetTableId}`).parents('.portlet').find('.actions')

            let height = el.outerHeight(true) ? el.outerHeight(true) : 20

            let top = el.offset().top ? el.offset().top + height : 200 + height;


            $(menu).css('top', `${top}px`)


            if (lang === 'ar') {
                $(menu).css('left', `4%`)
                $(menu).css('right', `auto`)

            } else {
                $(menu).css('right', `4%`)
                $(menu).css('left', `auto`)
            }
        }

    });


}