function unifiedHeight() {
    var unifiedHeight = [
        {'obj':$('.event'),'reserve':5,'except':null}
    ];

    $.each(unifiedHeight, function (k,item) {
        maxHeight(item.obj,item.reserve,item.except);
    });
}

function maxHeight(objects,reserve,exceptClassName) {
    if ($(window).width() > 768) {
        var maxHeight = 0
        objects.css('height','auto');
        objects.each(function () {
            var currentHeight = $(this).height() + parseInt($(this).css('padding-top')) + parseInt($(this).css('padding-bottom')) + (parseInt($(this).css('border-width')) * 2);
            if (currentHeight > maxHeight) maxHeight = currentHeight;
        });
        objects.not('.'+exceptClassName).css('height',maxHeight+reserve);
    } else {
        objects.not('.'+exceptClassName).css('height','auto');
    }
}