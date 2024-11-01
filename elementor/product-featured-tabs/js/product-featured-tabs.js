(function ($, window, document, undefined) {
    'use strict';
    let OEW = window.OEW || {};

    let $body = $('body'),
        $window = $(window);
    const item_slider = $('.oew-elementor-hero-video-banner .oew-hero-slides');

    OEW.FilterTabs = function () {
        let $reset = false;
        const widget = $('.oew-elementor-product-featured-tabs');
        if (widget.length) {
            widget.find('.action-filter').on('click', function () {
                const type = $(this).data('filter');
                const page = widget.find('.tab-product-content').data('page');
                const $row = widget.find('.oew-slick');
                const $params = widget.find('.oew-params').data('params');
                const data = {
                    'action': 'oew_filter_product_featured_tabs',
                    'type': type,
                    'per_page': page,
                    'params': $params,
                }

                $(this).siblings('.action-filter').removeClass('active');
                $(this).addClass('active');

                $.ajax({
                    method: 'POST',
                    url: oew_script.ajax_url,
                    data: data,
                    dataType: 'json',
                    beforeSend: function () {
                        $row.addClass('loading');
                    },
                    success: function (response) {
                        $row.removeClass('loading');

                        if ($row.hasClass('oew-slick')) {
                            $row.slick('unslick');
                            $row.html(response.text);
                            $row.slick();
                        } else {
                            $row.html(response.text);
                        }

                        if (response.load_more) {
                            // $this.parents('.bingo-product-filter-tab').find('.bingo-woo-loadmore').show();
                        }

                        $reset = true;
                    }
                });
            });
        }
    }

    $(document).ready(function () {
        OEW.FilterTabs();
    });
    $window.on('resize', function () {

    });

})(jQuery, window, document);