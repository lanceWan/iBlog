// Core Javascript Initialization
var App = function() {
    'use strict';

    // Scroll To Section
    var handleScrollToSection = function() {
        $(function() {
            $('a[href*=#scroll_]:not([href=#scroll_])').on('click', function() {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {

                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html,body').animate({
                            scrollTop: target.offset().top - 70
                        }, 1000);
                        return false;
                    }
                }
            });
        });
    }

    // Handle Animsition Function
    var handleAnimsitionFunction = function() {
        $(document).ready(function() {
            $(".animsition").animsition({
                inClass: 'fade-in',
                outClass: 'fade-out',
                inDuration: 1500,
                outDuration: 800,
                loading: true,
                loadingParentElement: 'body',
                loadingClass: 'animsition-loading',
                // loadingInner: '', // e.g '<img src="loading.svg" />'
                timeout: false,
                timeoutCountdown: 5000,
                onLoadEvent: true,
                browser: [
                    'animation-duration',
                    '-webkit-animation-duration',
                    '-moz-animation-duration',
                    '-o-animation-duration'
                    ],
                overlay: false,
                overlayClass: 'animsition-overlay-slide',
                overlayParentElement: 'body',
                transition: function(url){ window.location.href = url; }
            });
        });
    }

    // Fullheight
    var handleFullheight = function() {
        var WindowHeight = $(window).height(),
            HeaderHeight;

        if ($(document.body).hasClass('promo-top-offset')) {
            HeaderHeight = $('.fullheight-header-offset').height();
        } else {
            HeaderHeight = 0;
        }

        $('.fullheight').css('height', WindowHeight - HeaderHeight);

        $(window).resize(function() {
            var WindowHeight = $(window).height();
            $('.fullheight').css('height', WindowHeight - HeaderHeight);
        });
    }

    // Vertical Center Aligned
    // Note! This works only with promo block and background image via CSS.
    var handleVerticalCenterAligned = function() {
        $('.vertical-center-aligned').each(function() {
            $(this).css('padding-top', $(this).parent().height() / 2 - $(this).height() / 2);
        });
        $(window).resize(function() {
            $('.vertical-center-aligned').each(function() {
                $(this).css('padding-top', $(this).parent().height() / 2 - $(this).height() / 2);
            });
        });
    }

    // Handle Toggle Collapse Box
    var handleToggleCollapseBox = function() {
        $('.theme-toggle-trigger').on('click', function(event) {
            $(this).toggleClass('.theme-toggle-content').hide();
            $(this).toggleClass('is-open').show();
            $('.theme-toggle-content').slideToggle(400);
        });
    }

    // Handle Header Fullscreen Navigation Overlay
    var handleHeaderFullscreenOverlay = function() {
        var overlay = $('.header-fullscreen-nav-bg-overlay'),
            close = $('.header-fullscreen-nav-close'),
            trigger = $('.header-fullscreen-nav-trigger'),
            HeaderNavigation = $('.header-fullscreen-nav-overlay');

        trigger.on('click', function() {
            HeaderNavigation.removeClass('header-fullscreen-nav-overlay-show');
            HeaderNavigation.addClass('header-fullscreen-nav-overlay-show');
        });

        close.on('click', function(e) {
            e.stopPropagation();
            HeaderNavigation.removeClass('header-fullscreen-nav-overlay-show');
        });
    }

    // Handle Search Fullscreen
    var handleSearchFullscreen = function() {
        var overlay = $('.search-fullscreen-bg-overlay'),
            close = $('.search-fullscreen-close'),
            trigger = $('.search-fullscreen-trigger'),
            SearchFullscreen = $('.search-fullscreen-overlay');

        trigger.on('click', function() {
            SearchFullscreen.removeClass('search-fullscreen-overlay-show');
            SearchFullscreen.addClass('search-fullscreen-overlay-show');
        });

        close.on('click', function(e) {
            e.stopPropagation();
            SearchFullscreen.removeClass('search-fullscreen-overlay-show');
        });
    }

     // Handle Header Sticky
    var handleHeaderSticky = function() {
        // On loading, check to see if more than 15px, then add the class
        if ($('.header-sticky').offset().top > 15) {
            $('.header-sticky').addClass('header-shrink');
        }

        // On scrolling, check to see if more than 15px, then add the class
        $(window).on('scroll', function() {
            if ($('.header-sticky').offset().top > 15) {
                $('.header-sticky').addClass('header-shrink');
            } else {
                $('.header-sticky').removeClass('header-shrink');
            }
        });
    }
    // Handle Wow
    var handleWow = function() {
        var wow = new WOW({
            boxClass:     'wow',      // animated element css class (default is wow)
            offset:       0,          // distance to the element when triggering the animation (default is 0)
            mobile:       false,      // trigger animations on mobile devices (true is default)
            tablet:       false       // trigger animations on tablet devices (true is default)
        });
        wow.init();
    }

    return {
        init: function() {
            handleScrollToSection(); // initial setup for scroll to section
            handleFullheight(); // initial setup for fullheight
            handleVerticalCenterAligned(); // initial setup for vertical center aligned
            handleSearchFullscreen(); // initial setup for search fullscreen
            handleAnimsitionFunction();
            handleHeaderSticky();
            handleWow();

        }
    }
}();

$(document).ready(function() {
    App.init();
});
