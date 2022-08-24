(function(e, t, n) {
    if (typeof module != "undefined" && module.exports) module.exports = n();
    else if (typeof define == "function" && define.amd) define(n);
    else t[e] = n()
})("jquery-scrollto", this, function() {
    var e, t, n;
    e = t = window.jQuery || require("jquery");
    t.propHooks.scrollTop = t.propHooks.scrollLeft = {
        get: function(e, t) {
            var n = null;
            if (e.tagName === "HTML" || e.tagName === "BODY") {
                if (t === "scrollLeft") {
                    n = window.scrollX
                } else if (t === "scrollTop") {
                    n = window.scrollY
                }
            }
            if (n == null) {
                n = e[t]
            }
            return n
        }
    };
    t.Tween.propHooks.scrollTop = t.Tween.propHooks.scrollLeft = {
        get: function(e) {
            return t.propHooks.scrollTop.get(e.elem, e.prop)
        },
        set: function(e) {
            if (e.elem.tagName === "HTML" || e.elem.tagName === "BODY") {
                e.options.bodyScrollLeft = e.options.bodyScrollLeft || window.scrollX;
                e.options.bodyScrollTop = e.options.bodyScrollTop || window.scrollY;
                if (e.prop === "scrollLeft") {
                    e.options.bodyScrollLeft = Math.round(e.now)
                } else if (e.prop === "scrollTop") {
                    e.options.bodyScrollTop = Math.round(e.now)
                }
                window.scrollTo(e.options.bodyScrollLeft, e.options.bodyScrollTop)
            } else if (e.elem.nodeType && e.elem.parentNode) {
                e.elem[e.prop] = e.now
            }
        }
    };
    n = {
        config: {
            duration: 400,
            easing: "swing",
            callback: undefined,
            durationMode: "each",
            offsetTop: 0,
            offsetLeft: 0
        },
        configure: function(e) {
            t.extend(n.config, e || {});
            return this
        },
        scroll: function(e, r) {
            var i, s, o, u, a, f, l, c, h, p, d, v, m, g, y, b, w, E, S;
            i = e.pop();
            s = i.$container;
            u = i.$target;
            l = s.prop("tagName");
            a = t("<span/>").css({
                position: "absolute",
                top: "0px",
                left: "0px"
            });
            f = s.css("position");
            s.css({
                position: "relative"
            });
            a.appendTo(s);
            v = a.offset().top;
            m = u.offset().top;
            g = m - v - parseInt(r.offsetTop, 10);
            y = a.offset().left;
            b = u.offset().left;
            w = b - y - parseInt(r.offsetLeft, 10);
            c = s.prop("scrollTop");
            h = s.prop("scrollLeft");
            a.remove();
            s.css({
                position: f
            });
            E = {};
            S = function(t) {
                if (e.length === 0) {
                    if (typeof r.callback === "function") {
                        r.callback()
                    }
                } else {
                    n.scroll(e, r)
                }
                return true
            };
            if (r.onlyIfOutside) {
                p = c + s.height();
                d = h + s.width();
                if (c < g && g < p) {
                    g = c
                }
                if (h < w && w < d) {
                    w = h
                }
            }
            if (g !== c) {
                E.scrollTop = g
            }
            if (w !== h) {
                E.scrollLeft = w
            }
            if (s.prop("scrollHeight") === s.width()) {
                delete E.scrollTop
            }
            if (s.prop("scrollWidth") === s.width()) {
                delete E.scrollLeft
            }
            if (E.scrollTop != null || E.scrollLeft != null) {
                s.animate(E, {
                    duration: r.duration,
                    easing: r.easing,
                    complete: S
                })
            } else {
                S()
            }
            return true
        },
        fn: function(e) {
            var r, i, s, o;
            r = [];
            var u = t(this);
            if (u.length === 0) {
                return this
            }
            i = t.extend({}, n.config, e);
            s = u.parent();
            o = s.get(0);
            while (s.length === 1 && o !== document.body && o !== document) {
                var a, f;
                a = s.css("overflow-y") !== "visible" && o.scrollHeight !== o.clientHeight;
                f = s.css("overflow-x") !== "visible" && o.scrollWidth !== o.clientWidth;
                if (a || f) {
                    r.push({
                        $container: s,
                        $target: u
                    });
                    u = s
                }
                s = s.parent();
                o = s.get(0)
            }
            r.push({
                $container: t("html"),
                $target: u
            });
            if (i.durationMode === "all") {
                i.duration /= r.length
            }
            n.scroll(r, i);
            return this
        }
    };
    t.ScrollTo = t.ScrollTo || n;
    t.fn.ScrollTo = t.fn.ScrollTo || n.fn;
    return n
})