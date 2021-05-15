$(document).ready(function() {
    $('.edit-image-preview .image').each(function () {
        var self = $(this),
            width = self.width();
        if (!self.parents('.left-block').length) self.find('img').css('height',width/1.333333333333333);
    });
});