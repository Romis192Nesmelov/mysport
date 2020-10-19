$(document).ready(function () {
    var chatParent = $('#chat-modal, .chat-parent'),
        contractContainer = $('#chat-container');

    chatParent.find('button[type=submit]').click(function () {
        var textArea = chatParent.find('textarea'),
            message = textArea.val(),
            userIdInput = chatParent.find('input[name=user_id]'),
            fields = {
                '_token': chatParent.find('input[name=_token]').val(),
                'contract_id': chatParent.find('input[name=contract_id]').val(),
                'message': message
            };

        if (userIdInput.length) fields.user_id = userIdInput.val();

        if (message) {
            addLoaderScreen();
            $.post('/contract-chat',fields).done(function(data) {
                textArea.val('');
                contractContainer.html(data.data);
                removeLoaderScreen();
            }).fail(function(jqXHR, textStatus, errorThrown) {
                removeLoaderScreen();
            });
        }
    });

    $('td.chat-user > a').click(function (e) {
        e.preventDefault();
        var userId = $(this).attr('user-data');

        chatParent.find('input[name=user_id]').val(userId);
        addLoaderScreen();
        
        $.post('/user-contract-chat',{
            '_token': chatParent.find('input[name=_token]').val(),
            'contract_id': $('input[name=contract_id]').val(),
            'user_id': userId
        }).done(function(data) {
            contractContainer.html(data.data);
            removeLoaderScreen();
            $('#chat-modal').modal('show');
        }).fail(function(jqXHR, textStatus, errorThrown) {
            removeLoaderScreen();
        });
    });
});