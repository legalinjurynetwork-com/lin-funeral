<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" type="text/css">
</head>
<body>

<div class="container-fluid bg-white">
    <div class="row">
        <div class="col-12">

            <div class="text-content float-right mt-4">
                <h5>CALL US NOW <i class="fas fa-phone-alt" aria-hidden="true"></i><a href="tel:(833)643-8068"><span>(833) 643-8068</span></a></h5>
            </div>

        </div>

    </div>
</div>



<div class="container-fluid ">
    @yield('content')
</div>



<style media="screen">
    #park_image{
        position: absolute;
        z-index: -2;

        top: 0px;
        left: 0px;
        width: 100%;
    }

    #text{
        width: 100%;
        background-color:  #ffffff;
        padding: 15px;
        /* font-size: 14px!important; */

        max-width: 500px;
    }


    footer{
        position: absolute;
        bottom: 10px;
        margin: 5px;
    }

    body{
        background-repeat: no-repeat;
        background-size: cover;
        background-image: url('/images/grandparents.jpg');
        background-color: black!important;

    }


    @media screen and (max-width: 1500px) {
        body {
            background-size: inherit!important;

        }
    }



</style>

</body>
<footer class="text-center">
    <a href="/privacy">Privacy Policy</a>

</footer>


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
    fbq('track', 'Lead');
</script>
<noscript><img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=890388241749830&ev=PageView&noscript=1"
    /></noscript>
<!-- End Facebook Pixel Code -->

<!-- Offer Conversion: Funeral -->
<script type="text/javascript" src="https://track.legalinjuryadvocates.com/pixel.do?o=34&t=p"></script><noscript><img src="https://track.legalinjuryadvocates.com/pixel.do?o=34&t=p" width="1" height="1" /></noscript>
<!-- // End Offer Conversion -->

</html>









