(function($) {
    $.fn.exitModal = function(options) {

        options = $.extend({
            buttonClose: true,
            buttonsCloseOnlyForMobile: true,
            pageYValueForEventFired: 10,
            showCount: false,
            customTask: function() {}
        }, options);

        return this.each(function() {

            var $this = $(this);
            var currentDir;
            var isOut = false;
            var modalHeaderHtml;
            var shownCount = 0;

            function prependCloseButton() {
                if (!$this.find('.modal-header').length > 0) {
                    if (options.buttonsCloseOnlyForMobile) {
                        modalHeaderHtml = '<div class="exit-modal-header modal-header visible-mobile"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button></div>';
                    } else {
                        modalHeaderHtml = '<div class="exit-modal-header modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button></div>';
                    }
                    $this.find('.modal-content').prepend(modalHeaderHtml);
                }
            }

            function setCurrentDir() {
                $.mousedirection();
                $(document).bind("mousedirection", function(e) {
                    if (!isOut) {
                        currentDir = e.direction;
                    } else {
                        currentDir = 0;
                    }
                    isOut = false;
                });
            }

            function setIsOut() {
                $(document).mouseleave(function() {
                    isOut = true;
                })
            }

            function showModal() {
                if ((options.showCount === false) || (shownCount < options.showCount)) {
                    $this.modal();
                    if (options.buttonClose) {
                        prependCloseButton();
                    }
                }
            }

            function checkIfModalShouldAppear() {
                $(this).on('shown.bs.modal', function(e) {
                    shownCount++;
                });

                $(document).mousemove(function(e) {
                    if ((e.clientY <= options.pageYValueForEventFired) && ((currentDir == 'up') || (currentDir == 'top-left') || (currentDir == 'top-right'))) {
                        showModal();
                    }
                });
            }

            setCurrentDir();
            setIsOut();
            checkIfModalShouldAppear();

        })

    }

})(jQuery);