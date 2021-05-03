$(document).ready(function() {
    unifiedHeight();
    checkWindowHeight();
    // $('.styled').uniform();
    
    $(window).resize(function() {
        unifiedHeight();
        checkWindowHeight();
    });
    // singleHeight();

    // $('.styled').uniform();
    $('a.img-preview').fancybox({padding: 3});
    $('.avatar img').each(function () {
        if ($(this).width() > $(this).height()) {
            $(this).css({
                'width':'auto',
                'height':'100%'
            });
        }
    });

    $('table.datatable-basic').on('draw.dt', function () {
        bindDelete();
    });
    
    // Unlock to search button
    $('input[name=search]').keyup(function () {
        var searchButton = $('#searching');
        if ($(this).val().length) searchButton.prop('disabled',false);
        else searchButton.prop('disabled',true);
    });

    var scrollBlock = '.scroll-block';
    if ($(scrollBlock).length) {
        new PerfectScrollbar(scrollBlock);
    }
    
    // Owlcarousel
    var navButtonBlack1 = '<img src="/images/arrow_left_black.svg" />',
        navButtonBlack2 = '<img src="/images/arrow_right_black.svg" />',
        navButtonWhite1 = '<img src="/images/arrow_left_white.svg" />',
        navButtonWhite2 = '<img src="/images/arrow_right_white.svg" />';

    var enentsCalendar = $('.owl-carousel.calendar').owlCarousel({
        margin: 5,
        loop: true,
        nav: true,
        autoplay: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            729: {
                items: 1
            },
            1200: {
                items: 1
            }
        },
        navText:[navButtonWhite1,navButtonWhite2]
    });

    if (window.currentMonth) {
        for (var click=1;click<=window.currentMonth;click++) {
            enentsCalendar.trigger('next.owl.carousel');
        }
    }

    $('.owl-carousel.sports').owlCarousel({
        margin: 10,
        loop: true,
        nav: true,
        autoplay: true,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            729: {
                items: 3
            },
            1200: {
                items: 4
            }
        },
        navText:[navButtonBlack1,navButtonBlack2]
    });

    $('.owl-carousel.trainers').owlCarousel({
        margin: 20,
        loop: true,
        nav: true,
        autoplay: false,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            729: {
                items: 3
            },
            1200: {
                items: 4
            }
        },
        navText:[navButtonBlack1,navButtonBlack2]
    });

    $('.owl-carousel.gallery').owlCarousel({
        margin: 5,
        loop: true,
        nav: true,
        autoplay: true,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            729: {
                items: 1
            },
            1200: {
                items: 1
            }
        },
        navText:[navButtonWhite1,navButtonWhite2]
    });

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

    // Processing custom radio buttons
    $('.radio-buttons .cir').click(function () {
        var self = $(this),
            parent = self.parents('.radio-buttons'),
            input = parent.find('input'),
            currentActive = parent.find('.cir.active');

        if ( (parent.hasClass('type1') || parent.hasClass('type3') ) && !parent.hasClass('checkbox')) {
            currentActive.find('i').addClass('hidden');
            self.addClass('active').find('i').removeClass('hidden');
        }

        if (!parent.hasClass('checkbox')) {
            var newVal = self.attr('data');
            currentActive.removeClass('active');
            self.addClass('active');
            input.val(newVal);
        } else {
            if (self.hasClass('active')) {
                self.removeClass('active').find('i').addClass('hidden');
                input.val(0);
            } else {
                self.addClass('active').find('i').removeClass('hidden');
                input.val(1);
            }
        }
    });

    // Changing area select
    $('select.type1[name=area]').change(function () {
        window.location.href = '/area/?id='+$(this).val();
    });
});

function unifiedHeight() {
    var unifiedHeight = [
        {
            'obj'       :$('.event'),
            'reserve'   :0,
            'except'    :null,
            'include'   :$('.calendar-container')
        },
        {
            'obj'       :$('.trainer'),
            'reserve'   :20,
            'except'    :null,
            'include'   :null
        },
        {
            'obj'       :$('.trainers-block'),
            'reserve'   :0,
            'except'    :null,
            'include'   :null
        },
        {
            'obj'       :$('.kind-of-sport.col-xs-12'),
            'reserve'   :0,
            'except'    :null,
            'include'   :null
        }
    ];

    setTimeout(function () {
        $.each(unifiedHeight, function (k,item) {
            maxHeight(item.obj,item.reserve,item.except,item.include);
        });
    },1000);
}

function checkWindowHeight() {
    var footer = $('.footer'),
        contentHeight = $('.navbar').height() + $('.top-block').height() + $('.page-container').height() + footer.height();

    if (contentHeight < $(window).height()) {
        footer.css({
            'position':'fixed',
            'bottom':0
        });
    } else {
        footer.css({
            'position':'relative',
            'bottom':'auto'
        });
    }
}

function goToScroll(scrollData) {
    $('html,body').animate({
        scrollTop: $('div[data-scroll-destination="' + scrollData + '"]').offset().top
    }, 1500, 'easeInOutQuint');
}

function resetColorHrefsMenu() {
    $('.main-menu > a.active').removeClass('active').blur();
}