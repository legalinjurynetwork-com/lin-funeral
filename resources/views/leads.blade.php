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
    
    <script type="text/javascript" src="../../../assets/js/modernizr/3.2.0/modernizr.custom.min.js"></script>
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

    <div style="margin-top:50px; margin-bottom:50px;" class="container mt-5 mb-5 pt-5">
        <div class="row mt-5">
            <div class="col-12 text-center">
                <h1>List Of All Leads</h1>
            </div>
            
        </div>
        
    </div>
    
    <div id="page" class="site clearfix">
    
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">first_name</th>
                                <th scope="col">last_name</th>
                                <th scope="col">age</th>
                                <th scope="col">phone_number</th>
                                <th scope="col">email_address</th>
                                <th scope="col">postal_code</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($leads as $key => $lead)
                                <tr>
                                    <th scope="row">{{$lead->first_name}}</th>
                                    <td>{{$lead->last_name}}</td>
                                    <td>{{$lead->age}}</td>
                                    <td>{{$lead->phone_number}}</td>
                                    <td>{{$lead->email_address}}</td>
                                    <td>{{$lead->postal_code}}</td>
                                </tr>
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                    
                    
                </div>
                
            </div>
            
        </div>
        
        
        
        
        
        
        
        
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
            
            
            <script src="/covermyfuneral/js/jquery.min.js"></script>
            <script src="/covermyfuneral/js/bootstrap.min.js" type="text/javascript"></script>
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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-range/2.0.3/moment-range.min.js" type="text/javascript">
            </script>
            <script src="/covermyfuneral/js/custom.js?0.0.23" type="text/javascript"></script>
            <script src="/covermyfuneral/js/form.js?0.0.23" type="text/javascript"></script>
            
        </body>
        
        </html>
