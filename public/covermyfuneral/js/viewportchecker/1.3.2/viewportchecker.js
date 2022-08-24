(function($) {
    $.fn.viewportChecker = function(useroptions) {
        var options = {
            classToAdd: 'visible',
            offset: 100,
            callbackFunction: function(elem) {}
        };
        $.extend(options, useroptions);
        var $elem = this,
            windowHeight = $(window).height();
        this.checkElements = function() {
            var scrollElem = ((navigator.userAgent.toLowerCase().indexOf('webkit') != -1) ? 'body' : 'html'),
                viewportTop = $(scrollElem).scrollTop(),
                viewportBottom = (viewportTop + windowHeight);
            $elem.each(function() {
                var $obj = $(this);
                if ($obj.hasClass(options.classToAdd)) {
                    return;
                }
                var elemTop = Math.round($obj.offset().top) + options.offset,
                    elemBottom = elemTop + ($obj.height());
                if ((elemTop < viewportBottom) && (elemBottom > viewportTop)) {
                    $obj.addClass(options.classToAdd);
                    options.callbackFunction($obj);
                }
            });
        };
        $(window).scroll(this.checkElements);
        this.checkElements();
        $(window).resize(function(e) {
            windowHeight = e.currentTarget.innerHeight;
        });
    };
})(jQuery);