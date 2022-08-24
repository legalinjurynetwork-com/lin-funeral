<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>USA FUNERAL PLANNING</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="{{ asset('funeral/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('funeral/css/formValidation.css') }}" rel="stylesheet">

</head>

<body>
    <div class="logobar">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 col-sm-12 ">
                    <div class="row">
                        <div class="col-8">
                            <img src="/funeral/images/logo.png" class="img-fliud">
                        </div>
                        <div class="col-4 my-auto">
                            <h5 class="blu">Step 1 of 3</h5>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated  bg-bar"
                                    role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2 col-sm-12"><br>
                    <h1>
                        <center>Wait! Before we confirm your entry...</center>
                    </h1><br>

                    <hr>
                    <form action="{{ route('funeral-info-post2') }}" method="POST" id="frmLead1">
                        {{ csrf_field() }}
                        <br><br>
                        <div class="row form-group col-12">
                            <h3>Are you interested in a prepaid funeral for yourself or a loved one?</h3>
                            <ul class="customradios">
                                <li>
                                    <input type="radio" id="myself" name="myselfyesno" value="myself" required />
                                    <label for="myself">Yourself</label>
                                </li>
                                <li>
                                    <input type="radio" id="someoneelse" name="myselfyesno" value="someoneelse" required />
                                    <label for="someoneelse">Someone Else</label>
                                </li>
                            </ul>
                        </div>
                        <br><br>
                        <div class="form-group row">
                            <h3>What is your zip code, or the zip code of your loved one?</h3>
                            <div class="col-6">
                                <input type="text" name="zipcode" value="" class="form-control form-control-lg " required>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <input type="hidden" name="lead_id" value="{{$lead->id}}" />
                        <button type="submit" class="btn custom-button btn-lg">Next</button>
                    </form>
                </div>
                <div class="col-md-4 offset-md-4 col-sm-12"><br><br><br><br>
                    <h4 class="blu">Want to call us instead?</h4>
                    <p>Our prepaid funeral concierge care consultants are <strong>available 24/7.</strong></p>
                    <p><img src="/funeral/images/phone.svg"> <a href="tel:8336438068">(833) 643-8068</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="/funeral/js/jquery.js"></script>

	<script src="/funeral/js/formValidation.js"></script>

    <script src="/funeral/js/bootstrapfrm.js"></script>

	<script>
		 $(function() {

            $('#myself').click(function () {
                $("#Myself").attr('checked', 'checked');
            });
            $('.customradios').find('input:radio').on('change', function(){
                $('.customradios').find('li').removeClass('active');
                $(this).closest('li').addClass('active');
            })
            $('#notmyself').click(function () {
                $("#loved-one").attr('checked', 'checked');
            });

			$('form#frmLead1').formValidation({
                framework: 'bootstrap',
                message: 'This value is not valid',
                icon: {
                        valid: 'fas fa-check',
                        invalid: 'fas fa-times',
                        validating: 'fas fa-sync-alt'
                },
                fields: {
                        zipcode: {
                            validators: {
                                notEmpty: {
                                    message: 'The zip is required.'
                                },
                                regexp: {
                                    regexp: /^[0-9]{5}(?:-[0-9]{4})?$/,
                                    message: 'The input is not a valid zip code.'
                                }
                            }
                        },
                        myselfyesno: {
                            validators: {
                                notEmpty: {
                                    message: 'Please choose Yourself / Someone else.'
                                }
                            }
                        }

                    }
    		});
		});
	</script>
</html>
