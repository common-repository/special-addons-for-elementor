(function ($, window, document, undefined) {
    'use strict';
    let OEW = window.OEW || {};

    let $body = $('body'),
        $window = $(window);

    OEW.CountdownModule = function () {
        setInterval(function () {
            const obj = jQuery('.oew-countdown');
            obj.each(function () {
                const end = $(this).data('end');
                const gmt = $(this).data('gmt');
                const d = new Date();
                let n = d.getTime();
                let days = 0;
                let hours = 0;
                let minutes = 0;
                let seconds = 0;

                n = Math.floor(n / 1000);
                const cd = end - (n + (gmt * 3600));

                if (cd > 0) {
                    const sec_num = parseInt(cd, 10);
                    days = Math.floor(sec_num / 86400);
                    hours = Math.floor(sec_num / 3600) % 24;
                    minutes = Math.floor(sec_num / 60) % 60;
                    seconds = sec_num % 60;

                    if (seconds < 10) {
                        seconds = '0' + seconds;
                    }
                    if (minutes < 10) {
                        minutes = '0' + minutes;
                    }
                }
                $(this).find('.oew-days').text(days);
                $(this).find('.oew-hours').text(hours);
                $(this).find('.oew-mins').text(minutes);
                $(this).find('.oew-secs').text(seconds);
            });
        }, 1000);
    }

    $(document).ready(function () {
        OEW.CountdownModule();
    });

})(jQuery, window, document);
