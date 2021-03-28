$(document).ready(function() {
    unifiedHeight();
    // $('.styled').uniform();
    
    $(window).resize(function() {
        unifiedHeight();
    });
    // singleHeight();

    // $('.styled').uniform();
    $('a.img-preview').fancybox({padding: 3});

    // window.phoneRegExp = /^((\+)[0-9]{11})$/gi;
    $('input[name=phone]').mask("+7(999)999-99-99");
    $('input[name=born]').mask("99.99.9999");
    $('input[name=start_time],input[name=end_time]').mask("99.99");
    $('input[name=latitude],input[name=longitude]').mask("99.999999");
    
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
    bindAreaChange();
});

function bindAreaChange() {
    var select = $('select[name=area]');
    select.change(function () {
        if (window.uri == '/') {
            var value = $(this).val();
            select.unbind().val(value).change();
            bindAreaChange();
        } else {
            window.location.href = '/area/?id='+select.val();
        }
    });
}

function goToScroll(scrollData) {
    $('html,body').animate({
        scrollTop: $('div[data-scroll-destination="' + scrollData + '"]').offset().top
    }, 1500, 'easeInOutQuint');
}

function resetColorHrefsMenu() {
    $('.main-menu > a.active').removeClass('active').blur();
}