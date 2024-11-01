(function($, window, document) {
    $('.oew-item-popup-wrap').each(function() {
        var _this, item;
        _this = $(this);
        item = $(this).find('.oew-popup-item');
        $(this).click(function() {
            item.removeClass('active');
            return item.find('em').addClass('bullets');
        });
        item.each(function() {
            var $this;
            $this = $(this);
            $this.click(function(e) {
                e.stopPropagation();
                _this.find('.oew-popup-item').removeClass('active');
                _this.find('.oew-popup-item em').addClass('bullets');
                $this.addClass('active');
                return $this.find('em').removeClass('bullets');
            });
        });
    });
})(jQuery, window, document);