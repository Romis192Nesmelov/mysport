$(window).ready(function() {
    singleHeight();
    // $('.styled').uniform();
    
    $('table.calendar th i').click(function () {
        var thisTable = $(this).parents('table.calendar'),
            monthNum = parseInt(thisTable.attr('id').replace('month_','')),
            prevTable = thisTable.prev(),
            nextTable = thisTable.next();

        if ($(this).hasClass('icon-backward2') && !(monthNum == 2 && prevTable.is(':visible'))) {
            if (prevTable.is(':hidden')) {
                prevTable.removeClass('hidden');
                nextTable.addClass('hidden');
            } else {
                prevTable.prev().removeClass('hidden');
                thisTable.addClass('hidden');
            }
        } else if ($(this).hasClass('icon-forward3') && !(monthNum == 11 && nextTable.is(':visible')) ) {
            if (nextTable.is(':hidden')) {
                prevTable.addClass('hidden');
                nextTable.removeClass('hidden');
            } else {
                thisTable.addClass('hidden');
                nextTable.next().removeClass('hidden');
            }
        }
    });

    // Reload page
    // setTimeout(function () {
    //     location.reload(true);
    // }, 900000);
    // $(document.body).on('hidden.bs.modal', function () {
    //     var body = $('body');
    //     if (!body.hasClass('modal-open') && window.openedModal)
    //         body.addClass('modal-open').css('padding-right:',15);
    // }).on('shown.bs.modal', function() {
    //     if (window.openedModal) {
    //         $('#'+window.openedModal).modal('hide');
    //     }
    // });
    // $(window).resize(function() {
    //     singleHeight();
    // });
    // singleHeight();

    // $('.styled').uniform();
    // $('a.img-preview').fancybox({padding: 3});

    // window.phoneRegExp = /^((\+)[0-9]{11})$/gi;
    // $('input[name=phone]').mask("+7(999)999-99-99");

    // var sr = ScrollReveal();
    // sr.reveal('.navbar-default', {duration:1000});
    // sr.reveal('.cover', {duration:2000});
    // sr.reveal('.tasting', {duration:5000});

    
    // Owlcarousel
    // var owlCarousel = $('.owl-carousel');
    // owlCarousel.owlCarousel({
    //     margin: 20,
    //     loop: true,
    //     nav: true,
    //     autoplay: true,
    //     responsive: {
    //         0: {
    //             items: 1
    //         },
    //         729: {
    //             items: 2
    //         },
    //         1200: {
    //             items: 3
    //         }
    //     },
    //     navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>']
    // });
});