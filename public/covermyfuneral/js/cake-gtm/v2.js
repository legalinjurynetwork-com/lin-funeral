window.a4d = window.a4d || {};
(function() {
    'use strict';
    window.a4d.query = window.a4dQuery = url('?');
})();
(function() {
    'use strict';
    window.a4d.configDefaults = {
        defaults: {
            a: '430001',
            c: '',
            o: '',
            s1: '',
            s2: '',
            s3: '',
            s4: '',
            s5: ''
        },
        overrides: {
            t: 'TRANSACTION_ID'
        },
        iframeSelector: '#a4eventPixel',
        dataLayer: 'dataLayer'
    };
})();
(function() {
    'use strict';
    var dfd = $.Deferred();
    var config = window.a4d.config || window.a4dConfig;
    var wait = window.a4d.wait || window.a4dWait;
    window.a4d.configured = dfd.promise();
    if (config && !wait) {
        read(config);
    } else {
        window.a4d.config = window.a4dConfig = read;
        $(function() {
            var config = window.a4d.config || window.a4dConfig;
            var wait = window.a4d.wait || window.a4dWait;
            if (!wait) {
                if (config === read) {
                    read();
                } else {
                    read(config);
                }
            }
        });
    }

    function read(data) {
        if (window.a4d.configuring) {
            return;
        }
        window.a4d.configuring = true;
        if ($.isFunction(data)) {
            data = data();
        }
        if (data && $.isFunction(data.then)) {
            data.then(function(data) {
                resolve(data);
            });
        } else {
            resolve(data);
        }
    }

    function resolve(data) {
        var config = $.extend(true, {}, window.a4d.configDefaults, data);
        window.a4d.config = window.a4dConfig = config;
        dfd.resolve(config);
        $(document).trigger('a4dConfig', config);
    }
})();
(function() {
    'use strict';
    a4d.configured.then(function(config) {
        window.a4d.vars = window.a4dVars = $.extend({}, config.defaults, window.a4dQuery, config.overrides);
        return window.a4dVars;
    });
})();
(function() {
    'use strict';
    var iframe, containerId, a;
    a4d.configured.then(function(config) {
        iframe = $(config.iframeSelector);
        containerId = config.containerId;
    });
    window.a4d.cakeEventPixel = window.a4dCakeEventPixel = a = function(url, htmlId) {
        a4d.configured.then(function(config) {
            var gtm = google_tag_manager[containerId];
            iframe.one('load.a4dCakeEventPixel', function() {
                gtm.onHtmlSuccess(htmlId);
                if (a.dfd) {
                    a.dfd.resolve();
                    a.dfd = false;
                }
            });
            iframe.one('error.a4dCakeEventPixel', function() {
                gtm.onHtmlFailure(htmlId);
                if (a.dfd) {
                    a.dfd.reject();
                    a.dfd = false;
                }
            });
            iframe.prop('src', url);
        });
    };
})();
(function() {
    'use strict';
    var dataLayer, cakeEventPixel;
    a4d.configured.then(function(config) {
        dataLayer = window[config.dataLayer];
        cakeEventPixel = window.a4d.cakeEventPixel || window.a4dCakeEventPixel;
    });
    window.a4dGTM = function(name, vars) {
        var dfd = $.Deferred();
        cakeEventPixel.dfd = dfd;
        a4d.configured.then(function() {
            dataLayer.push($.extend({
                event: name
            }, vars));
        });
        return dfd.promise();
    };
})();