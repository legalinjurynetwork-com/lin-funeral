<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">

    <title>USA Funeral Planning</title>

    <script>
        document.documentElement.className = "js-enabled";

    </script>

    <link
        href='https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic%7cOpen+Sans:300italic,400italic,600italic,700italic,400,300,600,700'
        rel='stylesheet' type='text/css'>

    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" media="screen" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" href="/covermyfuneral/css/simple-line-icons/css/simple-line-icons.css">

    <link rel="stylesheet" href="/covermyfuneral/css/style.css?v=0.0.23">

    <link rel="stylesheet" href="/covermyfuneral/css/custom.css?v=0.0.23">

    <script type="text/javascript" src="/covermyfuneral/js/modernizr/3.2.0/modernizr.custom.min.js"></script>
    <link rel="stylesheet" type="text/css"  href="https://www.xverify.com/css/ui_tooltip_style.css"  />
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <link href="https://netdna.bootstrapcdn.com/respond-proxy.html" id="respond-proxy" rel="respond-proxy">
            <link href="../../../assets/js/respondjs/respond.proxy.gif" id="respond-redirect" rel="respond-redirect">
            <script src="../../../assets/js/respondjs/respond.proxy.js"></script>
        <![endif]-->
</head>

<body class="boxed">


    @if (Session::has('message'))
        <div class="flipInX  animated  alert flash_message" style="margin-bottom:0px!important;">{{ Session::get('message') }}</div>
    @endif

    @if (Session::has('error'))

        <div class="flipInX  animated  alert flash_message bg-danger" style="margin-bottom:0px!important;">{{ Session::get('error') }}</div>
    @endif

    @if (Session::has('success'))

        <div class="flipInX  animated alert success success_message bg-success" style="margin-bottom:0px!important;">{{ Session::get('success') }}</div>
    @endif


    <style media="screen">
        .flipInX.success{
            background-color:

        }
    </style>


    <div id="page" class="site clearfix">

        <div class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a id="logo_navbar" class="navbar-brand logo" href="#">
                        {{-- USA Funeral Planning --}}
                    <img id="logo_image"  src="/covermyfuneral/images/logo.png" alt="CoverMyFuneral" />
                    </a>
                </div>

                <div class="nav-inner navbar-right visible-lg visible-md">
                    <ul class="list-inline">
                        <li>
                            <h3>Step 1</h3>
                            <p><small>Fill in our short form</small></p>
                        </li>
                        <li class="arrow-nav">
                            <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                            <span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
                        </li>
                        <li>
                            <h3>Step 2</h3>
                            <p><small>Consider your options</small></p>
                        </li>
                        <li class="arrow-nav">
                            <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                            <span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
                        </li>
                        <li>
                            <h3>Step 3</h3>
                            <p><small>Enjoy peace of mind</small></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <section id="hero" class="section section-inverse">
            <div class="container">
                <div class="main-title">
                    <h1 class="main-heading">No Health Requirements. Simple, Affordable Funeral Plans</h1>
                    <h1 class="main-subheading"> Funeral costs are on the rise. Planning ahead is something you can do today to help your family years from now.
                    </h1>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="hero-img-container visible-md visible-lg">
                            <img class="hero-img rounded-4px" src="/covermyfuneral/images/family.png"
                                alt="hero" />
                        </div>
                        <section id="secure" class="section lower visible-lg visible-md">
                            <div class="security-list">
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-sm-offset-2 animated invisible visible">
                                        <img class="img-security img-security-1 img-responsive"
                                            src="/covermyfuneral/images/security-1.png" alt="TRUSTe">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 animated invisible visible">
                                        <img class="img-security img-security-2 img-responsive"
                                            src="/covermyfuneral/images/security-2.png" alt="Hacker Safe">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 animated invisible visible">
                                        <img class="img-security img-security-3 img-responsive"
                                            src="/covermyfuneral/images/security-3.png" alt="VeriSign">
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-5">
                        <div class="result"></div>
                        <form id="cover_form" method="POST" action="/post">
                            @csrf
                            <input type="hidden" name="is_ebook" value="true">
                            <div class="register-form">
                                <h3 class="step-heading">Get a FREE Funeral Planning Guide <span aria-hidden="true"
                                        class="glyphicon glyphicon-arrow-down"></span></h3>
                                <div class="form-group">
                                    <label class="standard-label" for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control"
                                        maxlength="30" value="" />
                                </div>
                                <div class="form-group">
                                    <label class="standard-label" for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control"
                                        maxlength="30" value="" />
                                </div>
                                <div class="form-group">
                                    <label class="standard-label" for="mobile_phone">
                                        What is Your Phone Number?
                                    </label>
                                    <input type="tel" name="phone_number" id="mobile_phone" class="form-control xverify_phone"
                                           maxlength="11" value="" />

                                </div>

                                <div class="form-group">
                                    <label class="standard-label" for="email_address">
                                        What is Your Email Address?
                                    </label>
                                    <input type="email" name="email_address" id="email_address" class="form-control xverify_email"
                                           maxlength="255" value="" />
                                </div>
                                <div class="form-group">
                                    <label class="standard-label" for="address">
                                        What is Your Address?
                                    </label>
                                    <input type="text" name="address" id="address" class="form-control"
                                           maxlength="255" value="" />
                                </div>
                                <div class="form-group" id="birthday-section">
                                    <label class="standard-label" for="birthday">
                                        What is Your Age?
                                    </label>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <select name="age" id="birthmonth" class="form-control required">
                                                <option value="45-59">45-59</option>
                                                <option value="60-65">60-65</option>
                                                <option value="66-69">66-69</option>
                                                <option value="70-75">70-75</option>
                                                <option value="76 or over">76 or over</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="standard-label" for="send_where">
                                        Where Should We Send Your Guide?
                                    </label>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <select name="send_where" id="send_where" class="form-control required">
                                                <option value="email">Email</option>
                                                <option value="mail">Mail</option>
                                                <option value="both">Both</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <p class="form-tip email-host-notification">Did you mean <span
                                            id="suggested-hosts"></span>?</p>
                                </div>
                                <div class="form-group submit-row form-group-submit">
                                    <input type="hidden" name="opt_in" id="opt_in" value="1" />
                                    <button type="submit" class="btn btn-warning btn-lg btn-block">Send My Free Guide</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <div class="security-list hidden-lg hidden-md">
            <div class="container">
                <div class="row">
                    <div class="col-xs-4 col-sm-2 col-sm-offset-3 animated invisible visible">
                        <img class="img-security img-security-1 img-responsive"
                            src="/covermyfuneral/images/security-1.png" alt="TRUSTe">
                    </div>
                    <div class="col-xs-4 col-sm-2 animated invisible visible">
                        <img class="img-security img-security-2 img-responsive"
                            src="/covermyfuneral/images/security-2.png" alt="Hacker Safe">
                    </div>
                    <div class="col-xs-4 col-sm-2 animated invisible visible">
                        <img class="img-security img-security-3 img-responsive"
                            src="/covermyfuneral/images/security-3.png" alt="VeriSign">
                    </div>
                </div>
            </div>
        </div>
        <section id="features" class="section feature-list bordered">
            <div class="container">
                <h2 class="standard-header text-center bar-center">Benefits of USA Funeral Planning</h2>
                <div class="feature-container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="circle">
                                <i class="icon icon-user"></i>
                            </div>
                            <div class="clearfix visible-lg"></div>
                            <div class="feature-details">
                                <p>Zero health restrictions. Acceptance guaranteed.</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="circle">
                                <i class="icon icon-badge"></i>
                            </div>
                            <div class="clearfix visible-lg"></div>
                            <div class="feature-details">
                                <p>Each plan is set up to be an effective way to help protect your family from rising
                                    funeral costs.</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="circle">
                                <i class="icon icon-map"></i>
                            </div>
                            <div class="clearfix visible-lg"></div>
                            <div class="feature-details">
                                <p>All plan options are a way to leave a legacy of love for your family</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="sentence" class="section section-inverse sentence text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="standard-header-2">Planning ahead isn't for you. It's for your family.</h2>
                        <h6> A funeral plan is an easy way to plan ahead.</h6>
                    </div>
                </div>
            </div>
        </section>
        <section id="sentence-2" class="section section-darker lower sentence-2 text-center">
            <div class="container">
                <div class="row">
                    <div>
                        <p>Start looking at plans today. Don't leave your family with the cost for a proper funeral.</p>
                    </div>
                    <div><a class="btn btn-main btn-lg uppercase" href="#hero">Get a FREE Funeral Planning Guide</a>
                    </div>
                </div>
            </div>
        </section>
        <section id="sentence-3" class="section section-inverse lower">
            <div class="container">
                <div class="row ">
                    <div class="col-md-3">
                        <a href="#hero"><img class="img-responsive adv adv-1"
                                src="/covermyfuneral/images/chart.png" alt=""></a>
                    </div>
                    <div id="quote_col" class="col-md-9 ">
                        <a href="#hero"><img class="img-responsive adv adv-2"
                                src="/covermyfuneral/images/quote.png" alt="Secure Every Step of Life"></a>
                    </div>
                </div>
                {{-- <div class="row ">
                    <div class="col-sm-6">
                        <a href="#hero"><img class="img-responsive adv adv-1"
                                src="/covermyfuneral/images/chart.png" alt=""></a>
                    </div>
                    <div class="col-sm-6">
                        <a href="#hero"><img class="img-responsive adv adv-2"
                                src="/covermyfuneral/images/adv-2-mobile.jpg"
                                alt="Secure Every Step of Life"></a>
                    </div>
                </div> --}}
            </div>
        </section>
        <footer id="footer" class="section footer">
            <div class="container">
                <div class="footer-legal-note">
                    <p>
                        By clicking "Get a FREE Funeral Planning Guide" you agree to our
                        <a href="/terms-and-conditions" title="Terms &amp; Conditions" target="_blank">Terms
                            &amp; Conditions.</a>
                    </p>
                </div>
                <div class="footer-layout">
                    <div class="footer-copyright">
                        &copy; 2015 - 2021 USA Funeral Planning 330 N Gould St. Suite 6116 Sheridan WY 82801
                        <br> Phone: (833) 643-8068

                    </div>
                    <div class="footer-nav">
                        <ul class="link-list-x">

                            <li><a href="/donotsell" target="_blank" title="About Us">Do Not Sell</a></li>
                            <li><a href="/privacy" target="_blank" title="Privacy Policy">Privacy
                                    Policy</a></li>
                            <li><a href="/terms-and-conditions" target="_blank" title="Terms &amp; Conditions">Terms &amp; Conditions</a>
                                <li><a href="/ccpa" target="_blank" title="Terms &amp; Conditions">CCPA</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <div class="scroll-to-top">
        <a href="#page" title="Scroll to top"><span class="glyphicon glyphicon-chevron-up"></span><span
                class="sr-only">Top</span></a>
    </div>

    <div class="modal modal-age fade" id="ageModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="no-margin text-center">Due to age requirement, you did not qualify for this type of
                        insurance. However, we have found for you a more suitable insurance coverage through our trusted
                        premium insurance partners</p>
                    <img class="img-responsive img-loader" src="/covermyfuneral/images/loader.gif"
                        alt="Loader">
                </div>
            </div>
        </div>
    </div>

    <div class="exit-modal modal fade" id="exitModal">
        <div class="exit-modal-dialog modal-dialog">
            <div class="exit-modal-content modal-content">
                <div class="exit-modal-header modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="exit-modal-body modal-body">
                    <div class="feature-list">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="person-box">
                                    <img class="circle" src="/covermyfuneral/images/gwyneth.jpg" alt="Gwyneth">
                                    <h4 class="person-header text-center">Gwyneth</h4>
                                    <p class="text-center">"I am able to reassure my family that my funeral expenses
                                        will not be a burden for them."</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="person-box">
                                    <img class="circle" src="/covermyfuneral/images/brandon.jpg" alt="Brandon">
                                    <h4 class="person-header text-center">Brandon</h4>
                                    <p class="text-center">"Thanks to Cover My Funeral, I can discuss ALL of my coverage
                                        options in just 1 phone call"</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="person-box">
                                    <img class="circle" src="/covermyfuneral/images/steven.jpg" alt="Steven">
                                    <h4 class="person-header text-center">Steven</h4>
                                    <p class="text-center">"A certified plan for later life expert guarantees my
                                        acceptance with no health restrictions."</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-center"></h3>
                    <a href="http://www.showm3.com/product.php?id=b368b999vf-9387b8a203-2ed8c6c351-5629596f83&affsub=CMFXTYexit"
                        class="btn btn-warning btn-lg cta-link" target="_blank"><span>People also like FREE QUOTES from
                            these offers<strong> &raquo;</strong></span></a>
                    <div class="row">
                        <div class="col-xs-4 col-sm-2 col-sm-offset-3">
                            <img class="img-security img-security-1 img-responsive"
                                src="/covermyfuneral/images/security-1.png" alt="TRUSTe">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                            <img class="img-security img-security-2 img-responsive"
                                src="/covermyfuneral/images/security-2.png" alt="Hacker Safe">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                            <img class="img-security img-security-3 img-responsive"
                                src="/covermyfuneral/images/security-3.png" alt="VeriSign">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="user_xverify_my_domain" value="https://roundup.legalinjuryadvocates.com">


        <!-- <script src="/covermyfuneral/js/jquery.min.js"></script> -->
        <script type="text/javascript" src="https://www.xverify.com/sharedjs/jquery-1.11.1.min.js"></script>
        <script src="/covermyfuneral/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://www.xverify.com/sharedjs/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://www.xverify.com/js/clients/tbassett4/client.js"></script>
    <script type="text/javascript" src="https://www.xverify.com/sharedjs/jquery.xverify.plugin.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.js"
        type="text/javascript"></script>
    <script src="/covermyfuneral/js/jquery.browser/0.0.7/jquery.browser.min.js" type="text/javascript">
    </script>

    <script src="/covermyfuneral/js/viewportchecker/1.3.2/viewportchecker.js" type="text/javascript"></script>
    <script src="/covermyfuneral/js/jquery.scrollto/jquery-scrollto-min.js" type="text/javascript"></script>
    <script src="/covermyfuneral/js/fuzzyset.js-master/lib/fuzzyset.js"></script>
    <script src="/covermyfuneral/js/garlicjs/1.2.3/garlic.min.js" type="text/javascript"></script>
    <script src="/covermyfuneral/js/js-url/2.3.0/url.min.js" type="text/javascript"></script>
    <script src="/covermyfuneral/js/jquery.exit-modal/jquery.mousedirection.js?v=0.0.23"></script>
    <script src="/covermyfuneral/js/jquery.exit-modal/jquery.exit-modal.js?v=0.0.23"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-range/2.0.3/moment-range.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $.xVerifyService({
                services: {
                    phone: {field: 'xverify_phone'},
                    email: {field: 'xverify_email'}
                },
                submitType: 'onChange'
            });
        });
    </script>


    <script src="/covermyfuneral/js/custom.js?0.0.23" type="text/javascript"></script>
    <script src="/covermyfuneral/js/form.js?0.0.23" type="text/javascript"></script>

    <script type="text/javascript">
    (function() {
        var field = 'xxTrustedFormCertUrl';
        var provideReferrer = false;
        var invertFieldSensitivity = false;
        var tf = document.createElement('script');
        tf.type = 'text/javascript';
        tf.async = true;
        tf.src = 'http' + ('https:' == document.location.protocol ? 's' : '') +
            '://api.trustedform.com/trustedform.js?provide_referrer=' + escape(provideReferrer) + '&field=' +
            escape(field) + '&l=' + new Date().getTime() + Math.random() + '&invert_field_sensitivity=' +
            invertFieldSensitivity;
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(tf, s);
    })();

</script>


<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '890388241749830');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=890388241749830&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->



<style media="screen">

@media only screen and (max-width: 991px) {

        #quote_col{
            margin-top: 2rem;
        }
}


</style>

<script type="text/javascript">
    const params = new URLSearchParams(window.location.search)
    for (const param of params) {
        var input = document.createElement("input");
  input.setAttribute("type", "hidden");
  input.setAttribute("name", param[0]);
  input.setAttribute("value", param[1]);
  //append to form element that you want .
  document.getElementById("cover_form").appendChild(input);
    }
    </script>

</body>

</html>
