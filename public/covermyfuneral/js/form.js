$(document).ready(function() {

    (function() {
        setTimeout(function() {
            var form = $('#cover_form');
            $.fn.garlic.defaults.excluded = 'input[type="file"], input[type="hidden"]:not([data-persist]), input[type="submit"]';
            $.fn.garlic.defaults.onRetrieve = function(elem) {
                elem.trigger('input');
            };
            $.fn.garlic.defaults.destroy = false;
            form.garlic();
            if (window.localStorage) {
                form.on('submit.a4d.garlicnuke', function(event) {
                    var key;
                    if (event.isDefaultPrevented()) {
                        return;
                    }
                    for (key in localStorage) {
                        if (key.indexOf('garlic:') === 0) {
                            localStorage.removeItem(key);
                        }
                    }
                });
            }
        }, 0);
    })();

    function refreshEventPixelIframe(eventPixelParameter) {
        var url = $('#iframe-event-pixel').data('url');
        var iframeEventPixelSrc = url + "&e=" + eventPixelParameter;
        if (eventPixelParameter) {
            $("#iframe-event-pixel").attr("src", iframeEventPixelSrc);
        } else {
            $("#iframe-event-pixel").attr("src", "");
        }
    }

    function notConsecutive(phone, consecutiveLength) {
        var consecutive = 0;
        for (var i = 0; i < phone.length; i++) {
            if (i < (phone.length - (consecutiveLength - 1))) {
                for (var j = 0; j < (consecutiveLength - 1); j++) {
                    if ((parseInt(phone[i + j]) + 1) == ((parseInt(phone[i + j + 1])))) {
                        consecutive++;
                    }
                }
            }
            if (consecutive == (consecutiveLength - 1)) {
                return false;
            } else {
                consecutive = 0;
            }
        }
        return true;
    }

    function notRepeating(phone, repeatingLength) {
        var repeating = 0;
        for (var i = 0; i < phone.length; i++) {
            if (i < (phone.length - (repeatingLength - 1))) {
                for (var j = 0; j < (repeatingLength - 1); j++) {
                    if ((parseInt(phone[i + j])) == ((parseInt(phone[i + j + 1])))) {
                        repeating++;
                    }
                }
                if (repeating == (repeatingLength - 1)) {
                    return false;
                } else {
                    repeating = 0;
                }
            }
        }
        return true;
    }

    jQuery.validator.addMethod('phone', function(phone_number, element) {
        return this.optional(element) || phone_number.match(/^[0-9]+$/);
    }, 'Please enter a valid phone number that contains only digits.');

    jQuery.validator.addMethod('phoneStart', function(phone_number, element) {
        return this.optional(element) || phone_number.match(/^0.*$/);
    }, 'Please enter a phone number that begins with "0".');

    jQuery.validator.addMethod('phoneLength', function(phone_number, element) {
        return this.optional(element) || phone_number.length > 9 && phone_number.length < 12;
    }, 'Please enter a phone number that is 10-11 digits.');

    jQuery.validator.addMethod('phoneRepeatingAndConsecutive', function(phone_number, element) {
        return this.optional(element) || (notRepeating(phone_number.split(''), 4) && notConsecutive(phone_number.split(''), 4));
    }, 'Please do not use consecutive or repeating numbers.');

    jQuery.validator.addMethod("phoneUK", function(phone_number, element) {
        phone_number = phone_number.replace(/\(|\)|\s+|-/g, "");
        return this.optional(element) || phone_number.length > 9 &&
            phone_number.match(/^(?:(?:(?:00\s?|\+)44\s?)|(?:\(?0))(?:\d{2}\)?\s?\d{4}\s?\d{4}|\d{3}\)?\s?\d{3}\s?\d{3,4}|\d{4}\)?\s?(?:\d{5}|\d{3}\s?\d{3})|\d{5}\)?\s?\d{4,5})$/);
    }, "Please specify a valid phone number.");

    jQuery.validator.addMethod("phonesUK", function(phone_number, element) {
        //phone_number = phone_number.replace(/\(|\)|\s+|-/g, "");
        return this.optional(element) || phone_number.length > 9 &&
            phone_number.match(/^(?:(?:(?:00\s?|\+)44\s?|0)(?:1\d{8,9}|[23]\d{9}|7(?:[1345789]\d{8}|624\d{6})))$/);
    }, "Please specify a valid uk phone number.");

    jQuery.validator.addMethod("phonesUKCustom", function(phone_number, element) {
        phone_number = phone_number.replace(/\(|\)|\s+|-/g, "");
        return this.optional(element) || phone_number.length > 9 &&
            phone_number.match(/^0?(?:(?:1\d{8,9}|[23]\d{9}|7(?:[1345789]\d{8}|624\d{6})))$/);
    }, "Please specify a valid uk phone number.");

    jQuery.validator.addMethod('noDots', function(value, element) {
        return this.optional(element) || value.match(/^[^.]+$/);
    }, 'Please enter a valid value without dots.');

    function isValidEmailAddress(emailAddress) {
        //var pattern = new RegExp(/^[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/);
        var pattern = new RegExp(/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/);
        return pattern.test(emailAddress);
    }

    // $("#marketing_agreement").on("change", function(){
    //     if( $(this).is(":checked") ) {
    //         $("#opt_in").val("yes");
    //     } else {
    //         $("#opt_in").val("no");
    //     }
    // });


    function emailDomainsPrompt() {
        var domains = [
            /* Default domains included */
            "aol.com", "att.net", "comcast.net", "facebook.com", "gmail.com", "gmx.com", "googlemail.com",
            "google.com", "hotmail.com", "hotmail.co.uk", "mac.com", "me.com", "mail.com", "msn.com",
            "live.com", "sbcglobal.net", "verizon.net", "yahoo.com", "yahoo.co.uk",

            /* Other global domains */
            "email.com", "games.com" /* AOL */ , "gmx.net", "hush.com", "hushmail.com", "icloud.com", "inbox.com",
            "lavabit.com", "love.com" /* AOL */ , "outlook.com", "pobox.com", "rocketmail.com" /* Yahoo */ ,
            "safe-mail.net", "wow.com" /* AOL */ , "ygm.com" /* AOL */ , "ymail.com" /* Yahoo */ , "zoho.com", "fastmail.fm",
            "yandex.com",

            /* United States ISP domains */
            "bellsouth.net", "charter.net", "comcast.net", "cox.net", "earthlink.net", "juno.com",

            /* British ISP domains */
            "btinternet.com", "virginmedia.com", "blueyonder.co.uk", "freeserve.co.uk", "live.co.uk",
            "ntlworld.com", "o2.co.uk", "orange.net", "sky.com", "talktalk.co.uk", "tiscali.co.uk",
            "virgin.net", "wanadoo.co.uk", "bt.com",

            /* Domains used in Asia */
            "sina.com", "qq.com", "naver.com", "hanmail.net", "daum.net", "nate.com", "yahoo.co.jp", "yahoo.co.kr", "yahoo.co.id", "yahoo.co.in", "yahoo.com.sg", "yahoo.com.ph",

            /* French ISP domains */
            "hotmail.fr", "live.fr", "laposte.net", "yahoo.fr", "wanadoo.fr", "orange.fr", "gmx.fr", "sfr.fr", "neuf.fr", "free.fr",

            /* German ISP domains */
            "gmx.de", "hotmail.de", "live.de", "online.de", "t-online.de" /* T-Mobile */ , "web.de", "yahoo.de",

            /* Russian ISP domains */
            "mail.ru", "rambler.ru", "yandex.ru", "ya.ru", "list.ru",

            /* Belgian ISP domains */
            "hotmail.be", "live.be", "skynet.be", "voo.be", "tvcablenet.be", "telenet.be",

            /* Argentinian ISP domains */
            "hotmail.com.ar", "live.com.ar", "yahoo.com.ar", "fibertel.com.ar", "speedy.com.ar", "arnet.com.ar",

            /* Domains used in Mexico */
            "hotmail.com", "gmail.com", "yahoo.com.mx", "live.com.mx", "yahoo.com", "hotmail.es", "live.com", "hotmail.com.mx", "prodigy.net.mx", "msn.com",

            /* Domains used in Brazil */
            "yahoo.com.br", "hotmail.com.br", "outlook.com.br", "uol.com.br", "bol.com.br", "terra.com.br", "ig.com.br", "itelefonica.com.br", "r7.com", "zipmail.com.br", "globo.com", "globomail.com", "oi.com.br"
        ];
        var checkingHost = FuzzySet(domains);
        var lastValue = $("#email_address").val();

        function checkEmailHost($element) {
            var value = $element.val();
            if (value != lastValue) {
                lastValue = value;
                var host = value.substring(value.indexOf('@') + 1);
                if ((value.indexOf('@') !== -1) && (host.length > 0)) {
                    var localPart = value.substring(0, value.indexOf('@'));
                    var result = checkingHost.get(host);
                    if (result) {
                        var resultLength = result.length;
                        var html = "";
                        $.each(result, function(key, value) {
                            if ((value[0] > 0.75) && (value[0] < 1)) {
                                html += "<a href='#' class='email-host'>" + localPart + "@" + value[1] + "</a>";
                                if (key !== resultLength - 1) {
                                    html += ", ";
                                }
                            }
                        });
                        if (html.length == 0) {
                            $(".email-host-notification").hide();
                        } else {
                            $("#suggested-hosts").html(html);
                            $(".email-host-notification").show();
                        }
                    }
                } else {
                    $("#suggested-hosts").empty();
                    $(".email-host-notification").hide();
                }
            }
        }
        $("#email_address").on('propertychange change click keyup input paste garlicRetrieve',
            // $.debounce(100, function() {
            //     checkEmailHost($(this));
            // })
        );
        $("#suggested-hosts").on('click', '.email-host', function(e) {
            e.preventDefault();
            var value = $(this).text();
            $("#email_address").val(value);
            $("#email_address").trigger("change");
            $("#email_address").valid();
        });
    }

    emailDomainsPrompt();

    function correctDate() {
        var choosenDay = $("#birthday").val();
        var choosenMonth = $("#birthmonth").val();
        var choosenYear = $("#birthyear").val();
        var start = moment().subtract(80, 'years');
        var end = moment().subtract(50, 'years');
        var range = moment().range(start, end);
        var when = moment(choosenYear + choosenMonth + choosenDay, "YYYYMMDD");
        return when.within(range);
    }

    function checkDate() {
        if (correctDate()) {
            $("#date-error").remove();
        } else {
            $("#date-error").remove();
            $("#birthday-section").append("<label id='date-error' class='error'>You must be 50 or older to apply.</label>");
        }
    }

    function calculateAge(year, month, day) {
        var when = moment(year + month + day, "YYYYMMDD");
        age = moment().diff(when, 'years');
        return age;
    }

    //check age and then age > 80 then redirect
    function redirectToAnotherLander() {
        var choosenDay = $("#birthday").val();
        var choosenMonth = $("#birthmonth").val();
        var choosenYear = $("#birthyear").val();
        var age = calculateAge(choosenYear, choosenMonth, choosenDay);
        if (age >= 80) {
            //refreshEventPixelIframe(2126);
            $('#ageModal').modal({
                backdrop: "static",
                keyboard: false
            });
            setTimeout(function() {
                window.location.href = "http://www.showm3.com/product.php?id=1a4e79f15b-b98caaebbf-f9817cd415-55db9cffae&affsub=CMFMODAL";
            }, 3000);
        }
    }

    // $("#birthyear").on("change", function(){
    //     redirectToAnotherLander();
    // });

    // Email Advanced Validation
    jQuery.validator.addMethod('emailadvanced', function(value, element) {
        return this.optional(element) || isValidEmailAddress(value);
    }, 'Please enter a valid email address.');

    $('#cover_form').validate({
        ignore: [],
        rules: {
            first_name: {
                required: true,
                noDots: true,
                minlength: 2
            },
            last_name: {
                required: true,
                noDots: true,
                minlength: 2
            },
            birthday: {
                required: true
            },
            birthmonth: {
                required: true
            },
            birthyear: {
                required: true
            },
            phone_number: {
                required: true,
                //digits: true,
                //phoneStart: true,
                //phoneRepeatingAndConsecutive: true,
              // phonesUKCustom: true
            },
            email_address: {
                required: true,
                //emailadvanced: true
            },
            postal_code: {
                required: true
            }
        },
        messages: {
            first_name: {
                required: "Please Provide your given name."
            },
            last_name: {
                required: "Please provide your surname."
            },
            mobile_phone: {
                required: "Please provide a valid phone number.",
                digits: "Please enter only digits and no spaces."
            },
            email_address: {
                required: "Please provide a valid email."
            }
        }
    });

    function clearNameFields() {
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();

        var first_name_temp_1 = first_name.replace(/ , | \. | \- | \_ /g, " ");
        var first_name_temp_2 = first_name_temp_1.replace(/, |\. |\- /g, " ");
        var first_name_new = first_name_temp_2.replace(/,|\.|\-|\_/g, " ");
        $("#first_name").val(first_name_new);

        var last_name_temp_1 = last_name.replace(/ , | \. | \- | \_ /g, " ");
        var last_name_temp_2 = last_name_temp_1.replace(/, |\. |\- /g, " ");
        var last_name_new = last_name_temp_2.replace(/,|\.|\-|\_/g, " ");
        $("#last_name").val(last_name_new);
    }

    //disable submit when pressing enter
    $("#cover_form input").keypress(function(e) {
        if (e.which == 13) {
            e.preventDefault();
        }
    });

    $("button[type='submit']").click(function(e) {
        e.preventDefault();
        clearNameFields();
        //checkDate();
        var choosenDay = $("#birthday").val();
        var choosenMonth = $("#birthmonth").val();
        var choosenYear = $("#birthyear").val();
        $("#age").val(calculateAge(choosenYear, choosenMonth, choosenDay));
        $("#dob").val(choosenDay + '/' + choosenMonth + '/' + choosenYear);
        $("#date_of_birth").val(choosenDay + '-' + choosenMonth + '-' + choosenYear);
        $("#cover_form").submit();
        // if(correctDate()) {
        //     $("#cover_form").submit();
        // } else {
        //     if ($("#cover_form").valid()) {
        //         clearTimeout(exitModal);
        //         $('#ageModal').modal({
        //             backdrop: "static",
        //             keyboard: false
        //         });
        //         setTimeout(function(){
        //             $("#cover_form").submit();
        //         }, 5000);
        //     }
        // }
    });

    //blocking submit button on submit event
    $('form').submit(function() {
        var $t = $(this);
        if ($t.valid()) {
            //refreshEventPixelIframe(1938);
            $t.find("button[type='submit']").attr({
                'disabled': 'disabled'
            }).addClass("input-submit-disabled");
        }
    });

    var exitModal;
    var idleTime = 15000;

    function setExitModal() {
        $('#exitModal').exitModal({
            buttonClose: false,
            buttonsCloseOnlyForMobile: false
        });
        exitModal = setTimeout(function() {
            $('#exitModal').modal();
        }, idleTime);
    }

    //setExitModal();

    function restartExitModal() {
        clearTimeout(exitModal);
        exitModal = setTimeout(function() {
            $('#exitModal').modal();
        }, idleTime);
    }

    $('#exitModal').on('hide.bs.modal', function(e) {
        restartExitModal();
    })

    //$("#cover_form input, #cover_form select").on('change focus keyup', $.debounce(250, restartExitModal) );

});