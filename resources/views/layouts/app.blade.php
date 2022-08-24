<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="unique_code_for_testing" content="56@#gh34h52*^%$g4hcDRTY">
    <meta name="google-site-verification" content="fc2eKZwELHogmp_63QmFAcm58HljI7y-lze5tF9lzcM">
    <meta property="fb:app_id" content="335379764341737">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="author" content="Torque">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    {{-- FAVICON --}}
    <link rel="shortcut icon" href="/images/favicon.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    {{-- OTHER STYLES --}}
    <link rel="stylesheet" href="/css/style.css">
    <title>TORQUE</title>
</head>
<body>
    <div id="app">
        @if (Session::has('message'))
            <div class="bg-info flipInX  animated  alert flash_message" style="margin-bottom:0px!important;">{{ Session::get('message') }}</div>
        @endif
        
        @if (Session::has('error'))
            
            <div class="bg-danger flipInX  animated  alert flash_message" style="margin-bottom:0px!important;">{{ Session::get('error') }}</div>
        @endif
        
        @if (Session::has('success'))
            
            <div class="bg-success flipInX  animated alert success success_message" style="margin-bottom:0px!important;">{{ Session::get('success') }}</div>
        @endif
        
        @if (isset($errors) && $errors->any())
            <div class="alert alert-danger">
                <div id="fix_spacing_menu"></div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        
        {{-- NAV --}}
        <header>
            <div class="container">
                <div class="header-content">
                    <div class="logo">
                        <a href="#"><img src="/images/torque-logo-large.webp" alt=""></a>
                    </div>
                </div>
            </div>
        </header>
        @yield('content')
        <footer>
            <div class="container">
                <div class="footer-logo">
                    <img src="/images/logo_large.webp" alt="">
                </div>
                <div class="links">
                    <ul>
                        <li>
                            <a href="">Contact US</a>
                        </li>
                        <li>
                            <a href="">Terms and Conditions</a>
                        </li>
                        <li>
                            <a href="">Privacy Policy</a>
                        </li>
                    
                    </ul>
                </div>
                <div class="copyright">
                    <p>&copy 2020 <a href="">Torque Detail</a>.All rights reserved</p>
                </div>
            </div>
        </footer>
        
        
    </div>
    
    {{-- LOAD JAVASCRIPT --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/js/custom.js"></script>
     {{-- FACEBOOK PIXEL  --}}
    <script type="text/javascript" id="">(function(d,a,b,f,e){d[e]=d[e]||[];d[e].push({projectId:"10000",properties:{pixelId:"10084698"}});var c=a.createElement(b);c.src=f;c.async=!0;c.onload=c.onreadystatechange=function(){var a=this.readyState,c=d[e];if(!a||"complete"==a||"loaded"==a)try{var b=YAHOO.ywa.I13N.fireBeacon;d[e]=[];d[e].push=function(a){b([a])};b(c)}catch(g){}};a=a.getElementsByTagName(b)[0];b=a.parentNode;b.insertBefore(c,a)})(window,document,"script","https://s.yimg.com/wi/ytc.js","dotq");</script>

    {{-- GOOOGLE TAG MANAGER  --}}
    <script>window.dataLayer = window.dataLayer || [];</script>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KQ2B24X');</script>
    
</body>
</html>
