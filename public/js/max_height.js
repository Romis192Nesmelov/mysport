function singleHeight() {
//     var singleHeight = [
//         $('.single-height')
//     ];
//
//     $.each(singleHeight, function (k,obj) {
//         maxHeight(obj);
//     });
}

function maxHeight(objects,exceptClassName) {
    if ($(window).width() > 768) {
        var maxHeight = 0;
        objects.css('height','auto');
        objects.each(function () {
            var currentHeight = $(this).height() + parseInt($(this).css('padding-top')) + parseInt($(this).css('padding-bottom')) + (parseInt($(this).css('border-width')) * 2);
            if (currentHeight > maxHeight) maxHeight = currentHeight;
        });
        objects.not('.'+exceptClassName).css('height',maxHeight);
    } else {
        objects.not('.'+exceptClassName).css('height','auto');
    }
}