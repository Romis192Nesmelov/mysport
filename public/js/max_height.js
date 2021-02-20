function unifiedHeight() {
    var unifiedHeight = [
        {
            'obj'       :$('.event'),
            'reserve'   :0,
            'except'    :null,
            'include'   :$('.calendar-container')
        }
    ];

    setTimeout(function () {
        $.each(unifiedHeight, function (k,item) {
            maxHeight(item.obj,item.reserve,item.except,item.include);
        });
    },1000);
}

function maxHeight(objects,reserve,exceptClassName,include) {
    if ($(window).width() > 768) {
        var maxHeight = 0
        objects.css('height','auto');
        objects.each(function () {
            var currentHeight = $(this).height() + parseInt($(this).css('padding-top')) + parseInt($(this).css('padding-bottom')) + (parseInt($(this).css('border-width')) * 2);
            if (currentHeight > maxHeight) maxHeight = currentHeight;
        });
        objects.not('.'+exceptClassName).css('height',maxHeight+reserve);
        if (include) include.css('height',maxHeight+reserve);
    } else {
        objects.not('.'+exceptClassName).css('height','auto');
    }
}