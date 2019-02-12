$(function () {
    new WOW().init();
});

$(document).on('keyup', '.search', function () {

    let term = $(this).val().toUpperCase();

    if (term) {

        $('.single').each(function () {

            let $this = $(this);

            let searchable = $this.attr('data-search').toUpperCase();

            searchable.includes(term.toUpperCase()) ? $this.show() : $this.hide();
        });
    } else {
        $('.single').show();
    }
});

$(document).on('click', '.filter', function (e) {

    e.preventDefault();

    $.get($(this).attr('href'),
        function (response) {
            let {
                courses
            } = response;
            if (courses.length) {
                let slugs = courses.map(course => course.slug);
                $('.single').each(function () {
                    let $this = $(this);
                    let slug = $this.attr('id');
                    slugs.includes(slug) ? $this.show() : $this.hide();
                });
            } else {
                $('.single').show();
            }
        },
    );
});

$(document).ready(function () {
    $('.selectpicker').selectpicker();
});


$(document).on('click', '#clear-search', function () {

    $('.single').show();
    $('input.search').val("");
});