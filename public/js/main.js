$(window).ready(function() {
    // singleHeight();
    // $('.styled').uniform();
    
    // $(window).resize(function() {
    //     singleHeight();
    // });
    // singleHeight();

    // $('.styled').uniform();
    // $('a.img-preview').fancybox({padding: 3});

    // window.phoneRegExp = /^((\+)[0-9]{11})$/gi;
    // $('input[name=phone]').mask("+7(999)999-99-99");
    
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

    // Scroll menu
    $('a[data-scroll]').click(function (e) {
        e.preventDefault();
        window.menuClickFlag = true;
        goToScroll($(this).attr('data-scroll'));
    });


    // Scroll controls
    // var onTopButton = $('#on-top-button');
    $(window).scroll(function() {
        if (!window.menuClickFlag) {
            var win = $(this);
            $('.section').each(function () {
                var scrollData = $(this).attr('data-scroll-destination');
                if (!win.scrollTop()) {
                    resetColorHrefsMenu();
                } else if ($(this).offset().top <= win.scrollTop()+50 && scrollData) {
                    resetColorHrefsMenu();
                    $('a[data-scroll-destination=' + scrollData + ']').addClass('active');
                }
            });
        }
        // if ($(window).scrollTop() > $(window).height()) onTopButton.fadeIn();
        // else onTopButton.fadeOut();
    });
});

function goToScroll(scrollData) {
    $('html,body').animate({
        scrollTop: $('.section[data-scroll-destination="' + scrollData + '"]').offset().top
    }, 1500, 'easeInOutQuint');
}

function resetColorHrefsMenu() {
    $('.main-menu > a.active').removeClass('active').blur();
}