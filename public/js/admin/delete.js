$(document).ready(function() {
    // Click to delete items
    $('.glyphicon-remove-circle').click(function () {
        var obj = $(this),
            deleteModal = $('#'+obj.attr('modal-data'));

        localStorage.clear();
        window.deleteId = obj.attr('del-data');
        window.deleteFunc = deleteModal.find('.modal-body').attr('del-function');
        window.deleteRow = obj.parents('tr').length ? obj.parents('tr').attr('id') : obj.parents('.col-xs-12').attr('id');
        window.deleteModal = obj.attr('modal-data');

        deleteModal.modal('show');
    });

    // Click to delete executor
    $('a.delete-executor').click(function () {
        var id = $(this).attr('del-data');
        $('#delete-executor-modal input[name=id]').val(id);
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