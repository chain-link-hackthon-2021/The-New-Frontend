<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
        <title>Register</title>

        <!-- ========== All CSS files linkup ========= -->
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/assets/css/lineicons.css" />
        <link rel="stylesheet" href="/assets/css/materialdesignicons.min.css" />
        <link rel="stylesheet" href="/assets/css/fullcalendar.css" />
        <link rel="stylesheet" href="/assets/css/main.css" />
        <script src="/assets/js/jquery.min.js"></script>
    </head>
    <body>
        <div class="overlay"></div>
        <!-- ======== sidebar-nav end =========== -->

        <!-- ======== main-wrapper start =========== -->
        <main class="main-wrapper" style="margin: 0;">
        <!-- ========== header start ========== -->
        <header class="header" style="padding: 10px 0;">
            <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-6">
                    <div class="header-left d-flex align-items-center">
                        <a href="/" id="header-logo" class="navbar-brand ml-1 p-0">
                            <img src="/images/cube.png" alt="AnyBuy Logo" class="brand-image img-circle elevation-3" width="50px" style="opacity: .8">
                            <span class="brand-text font-weight-light">AnyBuy</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-6">
                    <div class="header-right">
                        <a href="/Account/Register" class="btn btn-primary">Sign Up</a>
                    </div>
                    <!-- profile end -->
                </div>
                </div>
            </div>
            </div>
        </header>
        <!-- ========== header end ========== -->

        <!-- ========== signin-section start ========== -->
        <section class="signin-section">
            <div class="container-fluid" style="margin-top: 25px;">

            <div class="row g-0 auth-row">
                <div class="col-lg-6">
                    <div class="auth-cover-wrapper bg-primary-100">
                        <div class="auth-cover">
                        <div class="title text-center">
                            <h1 class="text-primary mb-10">Get Started</h1>
                            <p class="text-medium">
                            Start creating the best possible user experience
                            <br class="d-sm-block" />
                            for you customers.
                            </p>
                        </div>
                        <div class="cover-image">
                            <img src="assets/images/auth/signin-image.svg" alt="" />
                        </div>
                        <div class="shape-image">
                            <img src="assets/images/auth/shape.svg" alt="" />
                        </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-6">
                    <div class="signin-wrapper">
                        <div class="form-wrapper">
                            <h6 class="mb-15">Sign Up Form</h6>
                            <form class="login100-form validate-form" id="registerForm">
                                <h4 class="login100-form-title">
                                    <b>Create an Account</b>
                                </h4><br>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div id="all" style="display: none;" class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong style="font-size: 10px;" id="response"></strong>
                                            </div>
                                        </div>
                                        <div class="col-md-6" data-validate="First name is required">
                                            <input type="text" placeholder="First Name" class="input200 mb-25 form-control input-style-1cd server" id="firstname" data-val="true" data-val-required="The FirstName field is required." name="FirstName" value="" />
                                            <small id="firstnameres" style="display: none;" class="form-control mb-25  alert-danger" role="alert"></small>
                                        </div>
                                        <div class="col-md-6" data-validate="Last name is required">
                                            <input type="text" placeholder="Last Name" class="input200 mb-25 form-control input-style-1cd server" id="lastname" data-val="true" data-val-required="The LastName field is required." name="LastName" />
                                            <small id="lastnameres" style="display: none;" class="form-control mb-25  alert-danger" role="alert"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Email" class="input200 form-control mb-25 input-style-1cd serve" id="email" data-val="true" data-val-email="The Email field is not a valid e-mail address." data-val-required="The Email field is required." name="Email"/>
                                            <small id="emailres" style="display: none;" class="form-control alert-danger" role="alert"></small>
                                        </div>
                                    </div>
                                </div> <br>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Username" class="input200 form-control mb-25 input-style-1cd serve" id="username" data-val="true" data-val-length="The field Username must be a string with a minimum length of 5 and a maximum length of 15." data-val-length-max="15" data-val-length-min="5" data-val-required="The Username field is required." maxlength="15" name="Username" />
                                            <small id="usernameres" style="display: none;" class="form-control mb-25 alert-danger" role="alert"></small>
                                        </div>
                                    </div>
                                </div> <br>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input placeholder="Password" class="input200 mb-25 form-control input-style-1cd server" id="password" type="password" data-val="true" data-val-length="The Password must be at least 6 and at max 100 characters long." data-val-length-max="100" data-val-length-min="6" data-val-required="The Password field is required." maxlength="100" name="Password" />
                                            <small id="passwordres" style="display: none;" class="form-control mb-25 alert-danger" role="alert"></small>
                                        </div>
                                        <div class="col-md-6">
                                            <input placeholder="Confirm Password" class="input200 mb-25 form-control input-style-1cd server" id="confirm" type="password" data-val="true" data-val-equalto="The password and confirmation password do not match." data-val-equalto-other="*.Password" name="ConfirmPassword" />
                                            <small id="confirmres" style="display: none;" class="form-control mb-25 alert-danger" role="alert"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="container-login100-form-btn">
                                        <button type="submit" id="registerBtn" class="mb-25 btn btn-primary" name="submit">
                                            Create Account
                                        </button>
                                    </div>
                                </div>
                                <div class="text-center p-t-12">
                                    <a class="txt2" style="float:right" href="/Account/ForgotPassword">Forgot Password</a>
                                    <a class="txt2" style="float:left" href="/Account/Login">Login</a>
                                </div>
                                <div class="text-center p-t-136"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
            </div>
        </section>
        <!-- ========== signin-section end ========== -->

        </main>
        <!-- ======== main-wrapper end =========== -->

        <!-- ========= All Javascript files linkup ======== -->
        <script src="/assets/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/js/Chart.min.js"></script>
        <script src="/assets/js/dynamic-pie-chart.js"></script>
        <script src="/assets/js/moment.min.js"></script>
        <script src="/assets/js/fullcalendar.js"></script>
        <script src="/assets/js/jvectormap.min.js"></script>
        <script src="/assets/js/world-merc.js"></script>
        <script src="/assets/js/polyfill.js"></script>
        <script src="/assets/js/main.js"></script>
    </body>
</html>



<script>
    $(document).ready(function () {
        $("#registerForm").submit(function(e)  {
            e.preventDefault();
            $("#registerBtn").html("<i class='fa fa-spin fa-spinner'></i> Loading...")
            $("#registerBtn").attr("disabled")
            $("#all").css("display", "none");
            $("#emailres").css("display", "none");
            $("#passwordres").css("display", "none");
            $("#usernameres").css("display", "none");
            $("#firstnameres").css("display", "none");
            $("#confirmres").css("display", "none");
            $("#lastnameres").css("display", "none");
            let form = document.getElementById('registerForm');
            // var formData = new FormData(form);

            var email = $("#email").val();
            var password = $("#password").val();
            var confirm = $("#confirm").val();
            var username = $("#username").val();
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();

            var go = 1;

            if(firstname == ""){
                var go = 0;
                $("#firstnameres").html("Required");
                $("#firstnameres").css("display", "block");
            } 
            if(lastname == "") {
                var go = 0;
                $("#lastnameres").html("Required");
                $("#lastnameres").css("display", "block");
            }
            if(password == ""){
                var go = 0;
                $("#passwordres").html("Required");
                $("#passwordres").css("display", "block");
            }
            if(confirm == "") {
                var go = 0;
                $("#confirmres").html("Required");
                $("#confirmres").css("display", "block");
            }
            if(email == "") {
                var go = 0;
                $("#emailres").html("Required");
                $("#emailres").css("display", "block");
            }
            if(username == "") {
                var go = 0;
                $("#usernameres").html("Required");
                $("#usernameres").css("display", "block");
            }

            if(password != confirm){
                var go = 0;
                $("#passwordres").html("Password mismatch");
                $("#passwordres").css("display", "block");
            }

            if(go == 0){
                $("#registerBtn").html("Create Account")
                $("#registerBtn").attr("enabled")
            }

            if(go == 1){
                $.ajax({
                    type: 'post',
                    url: '<?= $registerUrl; ?>',
                    data: "email=" + email + "&password=" + password + "&username=" + username + "&firstname=" + firstname + "&lastname=" + lastname,
                    success: function (data) {
                        if(data.status === "error"){
                            $("#" + data.name + "res").html(data.message);
                            $("#" + data.name + "res").css("display", "block");
                        } else {
                            $("#all").css("display", "block");
                            $("#response").html("Registration successful! <br>Check your mail for verification link")
                            form.reset();
                        }
                        $("#registerBtn").html("Create Account")
                        $("#registerBtn").attr("enabled")
                    },
                    error: function(){
                        // alert(xhr.status);
                    }
                });
            } else {
                go = 0;
            }
        });

        $("#btn-sign-out").click(function () {
            $("#form-sign-out").submit();
        });
        
        var isTopNavLayout = $('body').hasClass('layout-top-nav');
        if (!isTopNavLayout) {
            $('#sidebar-nav-bars').show();
        } else {
            $('#header-logo').show();
        }
    });
</script>