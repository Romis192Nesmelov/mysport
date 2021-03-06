$(document).ready(function() {
    unifiedHeight();
    previewImageHeight();
    $(window).resize(function() {
        unifiedHeight();
        previewImageHeight();
    });

    $('a.img-preview').fancybox({
        padding: 3
    });

    $('table.datatable-basic').on('draw.dt', function () {
        bindDelete();
    });
});

function unifiedHeight() {
    var unifiedHeight = [
        {
            'obj'       :$('.gallery-photo'),
            'reserve'   :0,
            'except'    :null,
            'include'   :null
        }
    ];

    setTimeout(function () {
        $.each(unifiedHeight, function (k,item) {
            maxHeight(item.obj,item.reserve,item.except,item.include);
        });
    },500);
}

function translit(text, engToRus) {
    var rus = "щ ш ч ц ю я ё ж ъ ы э а б в г д е з и й к л м н о п р с т у ф х ь".split(/ +/g),
        eng = "shh sh ch cz yu ya yo zh `` y' e` a b v g d e z i j k l m n o p r s t u f x `".split(/ +/g);

    var x;
    for(x=0;x<rus.length; x++) {
        text = text.split(engToRus ? eng[x] : rus[x]).join(engToRus ? rus[x] : eng[x]);
        text = text.split(engToRus ? eng[x].toUpperCase() : rus[x].toUpperCase()).join(engToRus ? rus[x].toUpperCase() : eng[x].toUpperCase());
    }
    return text;
}