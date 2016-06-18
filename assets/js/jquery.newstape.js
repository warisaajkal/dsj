if (typeof Object.create !== "function") {
    Object.create = function(obj) {
        function F() {
        }
        F.prototype = obj;
        return new F();
    };
}

(function($, window, document) {
    var Newstape = {
        $elem: null,
        $content: null,
        options: {},
        height: 0,
        contentHeight: 0,
        dragstartPos: 0,
        dragDeltaY: 0,
        dragDeltaYReduce: 0,
        timer: null,
        pos: 0,
        init: function(options, el) {
            var base = this;

            base.$elem = $(el);
            base.$content = $('.newstape-content', base.$elem);

            base.options = $.extend({}, $.fn.newstape.options, base.$elem.data(), options);

            var heightRefresh = function() {
                base.height = base.$elem.outerHeight();
                base.contentHeight = base.$content.outerHeight();
            };
 
            if (base.options.heightSpy) {
                setInterval(heightRefresh, 1000);
            }

            heightRefresh();

            var play = function() {
                base.timer = setInterval(function() {
                    base.move();
                }, base.options.period);
            };

            base.$elem.bind('mouseover.newstape', function() {
                clearInterval(base.timer);
            });

            base.$elem.bind('mouseout.newstape', function() {
                play();
            });

            if (base.options.mousewheel) {
                base.$elem.bind('mousewheel.newstape', function(e) {
                    e.preventDefault();
                    base.pos = (e.deltaY > 0) ? base.pos + base.options.mousewheelRate : base.pos - base.options.mousewheelRate;
                    base.move();
                });
            }

            $('a', base.$elem).focus(function(e) {
                base.$elem.scrollTop(0);
                base.pos = base.height - $(this).position().top - $(this).outerHeight();
                base.move();
            });

            if (base.options.dragable) {
                base.$elem.bind('dragstart.newstape', function(e, dd) {
                    base.dragDeltaY = 0;
                    base.dragDeltaYReduce = 0;
                    base.dragstartPos = base.pos;
                    base.$elem.addClass('newstape-drag');
                }).bind('drag.newstape', function(e, dd) {
                    base.dragDeltaY = dd.deltaY;
                    base.pos = base.dragstartPos + (dd.deltaY - base.dragDeltaYReduce);
                    base.move();
                }).bind('dragend.newstape', function(e, dd) {
                    base.$elem.removeClass('newstape-drag');
                });
            }

            play();
        },
        move: function() {
            var base = this;

            var dragUpdate = function() {
                base.dragstartPos = base.pos;
                base.dragDeltaYReduce = base.dragDeltaY;
                base.dragDeltaY = 0;
            };

            if (base.pos <= base.contentHeight * -1) {
                base.pos = base.height;
                dragUpdate();
            }

            if (base.pos >= base.height + base.options.offset) {
                base.pos = base.contentHeight * -1;
                dragUpdate();
            }

            if (!base.$elem.hasClass('newstape-drag')) {
                base.pos = base.pos - base.options.offset;
            }

            base.$content.css('top', parseInt(base.pos) + 'px');
        }
    };

    $.fn.newstape = function(options) {
        return this.each(function() {
            if ($(this).data("newstape-init") === true) {
                return false;
            }

            $(this).data("newstape-init", true);
            var newstape = Object.create(Newstape);
            newstape.init(options, this);
            $.data(this, "newstape", newstape);
        });
    };

    $.fn.newstape.options = {
        period: 30,
        offset: 1,
        mousewheel: true,
        dragable: true,
        mousewheelRate: 30,
        heightSpy: true
    };

}(jQuery, window, document));
