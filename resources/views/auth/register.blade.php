@extends('layouts.alternative')
@section('css')
    <style>
        #login-container {
            padding: 30px;
            animation: fadeIn 0.5s ease-in-out;
            width: 150%;
            max-width: 400px;
            /* Lebih lebar dari sebelumnya */
        }

        .valid {
            color: green;
        }

        .invalid {
            color: red;
        }

        .valid-feedback {
            color: green;
            font-size: 14px;
            text-align: left;
            margin-left: 10px;
        }

        .invalid-feedback {
            color: red;
            font-size: 14px;
            text-align: left;
            margin-left: 10px;
        }
    </style>
@endsection
@section('body')
    @if (Auth::check())
        {{ redirect()->to('/')->send() }}
    @endif
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
                <section class="mb-30px">
                    <div class="hero-banner">
                        <div class="hero-banner__content">
                            <h3>TechBlog</h3>
                            <h1>The Amazing World of Technology</h1>
                            <h4>{{ $date }}</h4>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="card shadow rounded border-0 text-center" id="login-container">
                    <div class="card-body">
                        <h2 class="mb-4">Registration</h2>
                        <form action="{{ url('/register-check') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="input" class="form-control" name="name" id="nameRegis"
                                    placeholder="Full Name">
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="emailRegis"
                                    placeholder="Email">
                                <small id="email-feedback"></small>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password" id="passwordRegis"
                                    placeholder="Password">
                            </div>
                            <ul class="text-start" id="passwordRules" style="text-align: left;">
                                <li class="invalid" id="ruleLength">Min. 8 characters</li>
                                <li class="invalid" id="ruleUpper">Contain uppercase letter</li>
                                <li class="invalid" id="ruleLower">Contain lowercase letter</li>
                                <li class="invalid" id="ruleNumber">Contain number</li>
                                <li class="invalid" id="ruleSymbol">Contain symbol (!@#$%^&*.)</li>
                            </ul>
                            <div class="form-floating mt-3">
                                <input type="password" class="form-control" id="retypePasswordRegis"
                                    placeholder="Re-type password">
                            </div>
                            <small id="passwordMatch" class="text-start text-danger"></small>
                            <button type="submit" class="btn btn-success w-100 mt-4" id="registerBtn"
                                disabled>Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {

            let nameCheck = false;
            let emailCheck = false;
            let passwordCheck = false;
            let retypeCheck = false;

            //NAME HANDLER
            $('#nameRegis').on('keyup', function() {
                let name = $(this).val();
                if (name != '') {
                    nameCheck = true;
                } else {
                    nameCheck = false;
                }
                buttonSubmitCheck();
            })

            // EMAIL HANDLER
            $('#emailRegis').on('keyup', function() {
                let email = $(this).val();
                let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!emailRegex.test(email)) {
                    emailCheck = false;
                    $('#email-feedback').html('Not a valid email!').removeClass('valid-feedback').addClass(
                        'invalid-feedback').css('display', 'block');
                    buttonSubmitCheck();
                } else {
                    $.ajax({
                        url: window.location.origin + '/register-check-email',
                        type: 'GET',
                        beforeSend: function() {
                            emailCheck = false;
                            $('#email-feedback').html('');
                        },
                        data: {
                            email: email
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {

                            if (response.available) {
                                emailCheck = true;
                                $('#email-feedback').html('Email available').removeClass(
                                    'invalid-feedback').addClass('valid-feedback').css(
                                    'display', 'block');
                            } else {
                                emailCheck = false;
                                $('#email-feedback').html('Email not available').removeClass(
                                    'valid-feedback').addClass('invalid-feedback').css(
                                    'display', 'block');
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        },
                        complete: function() {
                            buttonSubmitCheck();
                        }
                    });
                }
            });
            // END EMAIL HANDLER
            // PASSWORD HANDLER
            $("#passwordRegis").on("keyup", function() {
                let password = $(this).val();
                validatePassword(password);
                buttonSubmitCheck();
            });

            $("#retypePasswordRegis").on("keyup", function() {
                let password = $("#passwordRegis").val();
                let retypePassword = $(this).val();
                validatePasswordMatch(password, retypePassword);
                buttonSubmitCheck();
            });

            function validatePassword(password) {
                let lengthCheck = password.length >= 8;
                let upperCheck = /[A-Z]/.test(password);
                let lowerCheck = /[a-z]/.test(password);
                let numberCheck = /[0-9]/.test(password);
                let symbolCheck = /[!@#$%^&*.]/.test(password);

                updateValidation("#ruleLength", lengthCheck);
                updateValidation("#ruleUpper", upperCheck);
                updateValidation("#ruleLower", lowerCheck);
                updateValidation("#ruleNumber", numberCheck);
                updateValidation("#ruleSymbol", symbolCheck);

                let allValid = lengthCheck && upperCheck && lowerCheck && numberCheck && symbolCheck;
                passwordCheck = allValid;

            }

            function validatePasswordMatch(password, retypePassword) {
                if (password === retypePassword && password.length > 0) {
                    retypeCheck = true;
                    $("#passwordMatch").text("Password match!").removeClass("text-danger").addClass("text-success");
                } else {
                    retypeCheck = false;
                    $("#passwordMatch").text("Password not match!").removeClass("text-success").addClass(
                        "text-danger");
                }

            }

            function updateValidation(selector, isValid) {
                if (isValid) {
                    $(selector).removeClass("invalid").addClass("valid");
                } else {
                    $(selector).removeClass("valid").addClass("invalid");
                }
            }

            function buttonSubmitCheck() {
                if (nameCheck && emailCheck && passwordCheck && retypeCheck) {
                    $('#registerBtn').prop('disabled', false);
                } else {
                    $('#registerBtn').prop('disabled', true);
                }
            }
            // END PASSWORD HANDLER
        });
    </script>
@endsection
