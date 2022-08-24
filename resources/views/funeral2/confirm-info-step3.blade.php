
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>USA FUNERAL PLANNING</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
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
                    <div class="col-4 my-auto"><h5 class="blu">Step 3 of 3</h5>
                    <div class="progress" style="height: 10px;">
                          <div class="progress-bar progress-bar-striped progress-bar-animated  bg-bar" role="progressbar" style="width: 75%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
        </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2 col-sm-12"><br>

                <form action="{{ route('funeral-info2-step3-post') }}" method="POST" id="frmLead3">
                {{ csrf_field() }}

                <br><br>
                <div class="row form-group col-12">

                <h3>Have you or your loved one been diagnosed with a terminal illness, or are you currently in hospice care?</h3>
                    <ul class="customradios">
                    <li>
                        <input type="radio" id="yesillness" name="illnesshospice" value="yesillness" required />
                        <label for="yesillness">Yes</label>
                    </li>
                    <li>
                        <input type="radio" id="noillness" name="illnesshospice" value="noillness" required />
                        <label for="noillness">No</label>
                    </li>
                    </ul>
                </div>
                <br>
                <hr>
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
        $('.customradios').find('input:radio').on('change', function(){
                $('.customradios').find('li').removeClass('active');
                $(this).closest('li').addClass('active');
        })

        $('form#frmLead3').formValidation({
            framework: 'bootstrap',
            message: 'This value is not valid',
            icon: {
                    valid: 'fas fa-check',
                    invalid: 'fas fa-times',
                    validating: 'fas fa-sync-alt'
            },
            fields: {
                    illnesshospice: {
                        validators: {
                            notEmpty: {
                                message: 'Please choose Yes / No'
                            }
                        }
                    }

                }
        });
    });
</script>
</html>
