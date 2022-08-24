<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>WIN A $2500 PREPAID FUNERAL!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="{{ asset('funeral/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('funeral/css/formValidation.css') }}" rel="stylesheet">

</head>

<body>
    <section id="giveaway">
        <div class="cover">
            <div class="confetti"></div>
            <div class="confetti"></div>
            <div class="confetti"></div>
            <div class="confetti"></div>
            <div class="confetti"></div>
            <div class="confetti"></div>
            <div class="confetti"></div>
            <div class="confetti"></div>
            <div class="confetti"></div>
            <div class="confetti"></div>
            <div class="container">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-12 text-center">
                    <h1>WIN A $2500 PREPAID FUNERAL!</h1>
                    <h3>For you or a loved one</h3>
                </div>
                <div class="col-xl-4 offset-xl-4 col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-12 stagecard">
                    @if (Session::has('error'))
                        <div class="flipInX  animated  alert flash_message bg-danger" style="margin-bottom:0px!important;">{{ Session::get('error') }}</div>
                    @endif
                    <form action="{{ route('funeral-post2') }}" method="POST" id="frmLead">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-12 text-center" required>
                                <h4>Enter here to WIN!</h4>
                            </div>
                            <div class="form-group col-6">
                                <input type="text" class="form-control giveawayfield" name="first_name" id="first_name" placeholder="First Name">
                            </div>
                            <div class="form-group col-6">
                                <input type="text" class="form-control giveawayfield" name="last_name" id="last_name" placeholder="Last Name">
                            </div>
                            <div class="form-group col-12">
                                <label style="font-size:10px;margin-left:10px;">Please enter a <strong>Mobile
                                        Number</strong> to confirm your entry</label>
                                <input type="tel" class="form-control giveawayfield" name="phone_home" id="phone_home" placeholder="Mobile Phone"
                                    required>
                            </div>
                            <div class="form-group col-12">
                                <label></label>
                                <input type="email" name="email_address" id="email_address"  class="form-control giveawayfield" placeholder="Email">
                            </div>

                            <div class="col-12 text-center">

                                <button type="submit" class="btn custom-button btn-lg">Enter to Win</button><br><br>
                                <center>No Purchase Neccesarry. $2,500 Value. You will receive a text message to confirm
                                    your entry. </center>
                            </div>
                            <div class="col-12 optin"><br>
                                By entering your phone number, you agree that we may send you text notifications
                                confirming your entry. Text marketing messages will not exceed 5 a month.
                                Reply "STOP" at any time to opt out. Message and data rates may apply.
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="padme">&nbsp;</div>
        </div>
    </section>
    <div class="privacy-bar">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    Copyright © {{ now()->year }} | All rights reserved.
                    <br><br><br>
                    <a href="{{ route('terms-and-conditions') }}" target="_blank">Terms &amp;
                        Conditions</a> |
                    <a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a> |
                    <a href="{{ route('ccpa') }}" target="_blank">CCPA</a> |
                    <a href="{{ route('donotsell') }}" target="_blank">Do Not Sell</a>

                </div>

            </div>
        </div>
    </div>
</body>

    <script src="/funeral/js/jquery.js"></script>
    <script src="/funeral/js/jquery.inputmask.bundle.min.js"></script>

	<script src="/funeral/js/formValidation.js"></script>

    <script src="/funeral/js/bootstrapfrm.js"></script>

	<script>
		 $(function() {

            $("#phone_home").inputmask('(999)-999-9999'); 

			$('form#frmLead').formValidation({
                framework: 'bootstrap',
                message: 'This value is not valid',
                icon: {
                        valid: 'fas fa-check',
                        invalid: 'fas fa-times',
                        validating: 'fas fa-sync-alt'
                },
                fields: {
                        first_name: {
                            validators: {
                                notEmpty: {
                                    message: 'The first name is required.'
                                }
                            }
                        },
                        last_name: {
                            validators: {
                                notEmpty: {
                                    message: 'The last name is required.'
                                }
                            }
                        },
                        // zip_code: {
                        //     validators: {
                        //         notEmpty: {
                        //             message: 'The zip is required.'
                        //         },
                        //         regexp: {
                        //             regexp: /^[0-9]{5}(?:-[0-9]{4})?$/,
                        //             message: 'The input is not a valid zip code.'
                        //         }
                        //     }
                        // },
                        phone_home: {
                            validators: {
                                notEmpty: {
                                    message: 'The mobile number is required.'
                                },
								regexp: {
                                    regexp: /^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/,
                                    message: 'The input is not a valid mobile number.'
                                }
                            }
                        },
                        email_address: {
                            validators: {
                                notEmpty: {
                                    message: 'The email Address is required.'
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/,
                                    message: 'The input is not a valid email address.'
                                }
                            }
                        }
                    }
    		});
		});
	</script>

</html>
