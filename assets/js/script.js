(function ($, window, document, undefined) {
    'use strict';
    let OEW = window.OEW || {};

    OEW.SlickSlider = function () {
        const slick = $('.oew-slick');
        const dotsType = $('.oew-pagination-type-progressbar');
        const progressBar = dotsType.find('.progress');

        // if (slick.length) {
        slick.slick({
            prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><i class="fas fa-angle-left"></i></button>',
            nextArrow: '<button class="slick-next" aria-label="Next" type="button"><i class="fas fa-angle-right"></i></button>',
        });

        if (dotsType.length) {
            slick.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
                const value = ((nextSlide) / (slick.slideCount - 1)) * 100;

                progressBar.css('background-size', value + '% 100%');
            });
        }
        // }
    };

    OEW.QuickView = function () {
        $('.oew-action-quickview .btn-quickview').on('click', function () {
            const $this = $(this);
            const $p_id = $this.attr('data-id');

            const data = {
                'action': 'oew_render_modal_quick_view',
                'product_id': $p_id,
            };

            $.ajax({
                method: 'POST',
                url: oew_script.ajax_url,
                data: data,
                dataType: 'json',
                beforeSend: function () {
                    $this.addClass('loading');
                },
                success: function (response) {
                    $this.removeClass('loading');
                    $('body').append(response.data);

                    $('.oew-quick-view-background, .oew-quick-view-close').on('click', function () {
                        $('.oew-product-quick-view-popup').remove();
                    });

                    $('.oew-quick-view-images .oew-inner-images').slick();
                },
                error: function (response) {
                    console.log(response);
                }
            });
        })
    };

    $(document).ready(function () {
        OEW.SlickSlider();
        OEW.QuickView();
    });

    $(window).on('elementor/frontend/init', function () {

    });
})(jQuery, window, document);