(function ($, window, document, undefined) {
    'use strict';
    let OEW = window.OEW || {};

    let $body = $('body'),
        $window = $(window);
    const item_slider = $('.oew-elementor-hero-video-banner .oew-hero-slides');

    OEW.ItemSlider = function () {
        if ($window.width() < 992) {
            item_slider.slick({
                prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><i class="fas fa-angle-left"></i></button>',
                nextArrow: '<button class="slick-next" aria-label="Next" type="button"><i class="fas fa-angle-right"></i></button>',
            });
        }
    }

    OEW.DotsProgressBar = function () {
        const dotsType = $('.oew-pagination-type-progressbar');
        const progressBar = dotsType.find('.progress');

        if (dotsType.length > 0 && item_slider.length > 0) {
            item_slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
                const value = ( (nextSlide) / (slick.slideCount-1) ) * 100;

                progressBar.css('background-size', value + '% 100%');
            });
        }
    }

    $(document).ready(function () {
        OEW.ItemSlider();
        OEW.DotsProgressBar();
    });
    $window.on('resize', function () {
        OEW.ItemSlider();
    });

})(jQuery, window, document);