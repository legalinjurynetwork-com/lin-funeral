/**
 * custom.js
 * custom JavaScript functions and plugin initialization
 */
$(function() {

    /* Scroll to top button */

    function scrollToTop() {
        var btn = $('.scroll-to-top');
        btn.hide();
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                btn.fadeIn(300);
            } else {
                btn.fadeOut(300);
            }
        });
    }

    scrollToTop();

}); // end $(function () {})


$(document).ready(function() {

    /**
     * Smooth scrolling
     * Adapted from: http://css-tricks.com/snippets/jquery/smooth-scrolling/
     */

    function smoothLinkScroll() {
        var scroll_links = $("a[href*=#]:not([href=#], [role='tab'], .panel-title a)");
        scroll_links.each(function() {
            var $this = $(this);
            $this.click(function() {
                if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
                    var target = $(this.hash),
                        offset = $(".navbar-header").outerHeight();
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html,body').animate({
                            scrollTop: target.offset().top - offset + 1
                        }, 1000);
                        return false;
                    }
                }
            });
        });
    }

    smoothLinkScroll();

    /**
     * Animate items as they appear
     * uses jQuery viewport checker plugin
     */

    function animateWhenVisible() {
        var anim_items = $('.animated'),
            no_animation = $('body').hasClass('no-animation');
        if (anim_items.length && !no_animation) {
            anim_items.addClass('invisible').viewportChecker({
                classToAdd: null,
                offset: 100,
                callbackFunction: function(elem) {
                    var animclass = elem.data('animation'),
                        animdelay = elem.data('animdelay');
                    if (animdelay) {
                        setTimeout(function() {
                            elem.addClass('visible ' + animclass);
                        }, animdelay);
                    } else {
                        elem.addClass('visible ' + animclass);
                    }
                }
            });
        }
    }

    animateWhenVisible();

    // tooltip
    $(".help-icon").click(function(e) {
        e.preventDefault();
    });
    $('.help-icon-right').tooltip({
        placement: 'right',
        html: true,
        trigger: "hover focus click"
    });
    $('.help-icon-left').tooltip({
        placement: 'left',
        html: true,
        trigger: "hover focus click"
    });



}); // end $(document).ready(function () {})