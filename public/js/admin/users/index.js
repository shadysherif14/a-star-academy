$(document).on('submit', '.delete', function (e) {
    e.preventDefault();
    let action = $(this).attr('action');
    let $form = $(this);
    swal({
        title: 'Are you sure?',
        text: "Deleting a user will completely erase all of his/her data, including information, subscription and all other related data that belongs to that user.",
        type: "warning",
        customClass: 'swal-delete',
        background: "#222",
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Keep',
        confirmButtonColor: '#CF000F',
        cancelButtonColor: '#f3b715',
        focusCancel: true
    }).then(result => {
        if (result.value) {
            CSRFToken();
            $.ajax({
                type: 'DELETE',
                url: action,
                success: function (response) {
                    $form.closest('tr').remove();
                }
            });
        }
    });
});


$(document).on('submit', '.block', function (e) {
    e.preventDefault();
    let action = $(this).attr('action');
    let $form = $(this);
    swal({
        title: 'Are you sure?',
        text: "Blocking a user means that s/he has no longer access to anything (even cannot login), but his data will be still available in our database, and you can unblock him/her.",
        type: "warning",
        customClass: 'swal-delete',
        background: "#222",
        showCancelButton: true,
        confirmButtonText: 'Block',
        cancelButtonText: 'Keep',
        confirmButtonColor: '#CF000F',
        cancelButtonColor: '#f3b715',
        focusCancel: true
    }).then(result => {
        if (result.value) {
            CSRFToken();
            $.ajax({
                type: 'PUT',
                url: action,
                success: () => {
                    swal.fire({
                        'type': 'success',
                        'text': 'User has been blocked successfully'
                    });
                    
                    $form.parents('tr').removeClass('row-unblocked');
                    $form.parents('tr').addClass('row-blocked');
                    
                    $form.removeClass('block').addClass('unblock');
                    $form.find('button i').removeClass('fa-user-alt-slash').addClass('fa-user-alt');
                }
            });
        }
    });
});

$(document).on('submit', '.unblock', function (e) {
    e.preventDefault();
    let action = $(this).attr('action');
    let $form = $(this);
    CSRFToken();
    $.ajax({
        type: 'PUT',
        url: action,
        success: () => {
            swal.fire({
                'type': 'success',
                'text': 'User has been unblocked successfully'
            });
            
            $form.parents('tr').addClass('row-unblocked');
            $form.parents('tr').removeClass('row-blocked');
            
            $form.removeClass('unblock').addClass('block');
            $form.find('button i').removeClass('fa-user-alt').addClass('fa-user-alt-slash');
        }
    });
});

$(document).on('click', '#showAll', function (e) {
    e.preventDefault();
    $('table tr').slideDown();
});

$(document).on('click', '#showBlocked', function (e) {
    e.preventDefault();
    $('table tr').slideUp();
    $('table tr.row-blocked').slideDown();
});