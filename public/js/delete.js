$(document).ready(function() {
    // Click to delete items
    $('.delete-icon').click(function () {
        var obj = $(this),
            deleteModal = $('#'+obj.attr('modal-data'));

        localStorage.clear();
        window.deleteId = obj.attr('del-data');
        window.deleteFunc = deleteModal.find('.modal-body').attr('del-function');
        window.deleteRow = obj.parents('tr').length ? obj.parents('tr').attr('id') : obj.parents('.col-xs-12').attr('id');
        window.deleteModal = obj.attr('modal-data');

        deleteModal.modal('show');
    });

    // Click YES on delete modal
    $('.delete-yes').click(function () {
        $('#'+window.deleteModal).modal('hide');
        addLoaderScreen();

        $.post(window.deleteFunc, {
            '_token': $('input[name=_token]').val(),
            'id': window.deleteId
        }, function (data) {
            if (data.success) {
                removeLoaderScreen();
                var row = window.deleteRow;
                $('#'+row).remove();
            }
        });
    });
});