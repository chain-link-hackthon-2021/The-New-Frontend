<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
        <title>Sign In | AnyBuy</title>

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
        <br />
        <!-- ========== signin-section start ========== -->
        <section class="signin-section">
            <div class="container-fluid" style="margin-top: 25px;">

            <div class="row g-0 auth-row">
                <div class="col-lg-6">
                <div class="auth-cover-wrapper bg-primary-100">
                    <div class="auth-cover">
                    <div class="title text-center">
                        <h1 class="text-primary mb-10">Welcome Back</h1>
                        <p class="text-medium">
                        Sign in to your Existing account to continue
                        </p>
                    </div>
                    <div class="cover-image">
                        <img src="/assets/images/auth/signin-image.svg" alt="" />
                    </div>
                    <div class="shape-image">
                        <img src="/assets/images/auth/shape.svg" alt="" />
                    </div>
                    </div>
                </div>
                </div>
                <!-- end col -->
                <div class="col-lg-6">
                <div class="signin-wrapper">
                    <div class="form-wrapper">
                    <h6 class="mb-15">Sign In Form</h6>
                    <p class="text-sm mb-25">
                        Start creating the best possible user experience for you
                        customers.
                    </p>
                    <form id="loginForm">
                        <div class="row">
                            <div class="col-12">
                                <?php if (session()->getFlashdata('success')) : ?>
                                    <div class="alert alert-success">
                                        <?= session()->getFlashdata('success'); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (session()->getFlashdata('error')) : ?>
                                    <div class="alert alert-danger">
                                        <?= session()->getFlashdata('error'); ?>
                                    </div>
                                <?php endif; ?>
                                <div style="display: none;" id="bothres" class="alert alert-danger"></div>
                                <div class="input-style-1">
                                    <label for="Email">Email</label>
                                    <input type="email" id="Email" placeholder="Email" />
                                </div>
                                <div style="display: none;" id="emailres" class="alert alert-danger"></div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="Password"> Password</label>
                                    <input type="password" id="Password" placeholder="Password" />
                                </div>
                                <div style="display: none;" id="passwordres" class="alert alert-danger"></div>
                            </div>
                        <!-- end col -->
                        <div class="col-xxl-6 col-lg-12 col-md-6">
                            <div class="form-check checkbox-style mb-30">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                value=""
                                id="checkbox-remember"
                            />
                            <label
                                class="form-check-label"
                                for="checkbox-remember"
                            >
                                Remember me next time</label
                            >
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-xxl-6 col-lg-12 col-md-6">
                            <div
                            class="
                                text-start text-md-end text-lg-start text-xxl-end
                                mb-30
                            "
                            >
                            <a href="#" class="hover-underline"
                                >Forgot Password?</a
                            >
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-12">
                            <div
                            class="
                                button-group
                                d-flex
                                justify-content-center
                                flex-wrap
                            "
                            >
                                <button type="submit" id="loginBtn" class=" main-btn primary-btn btn-hover w-100 text-center ">
                                    Sign In
                                </button>
                            </div>
                        </div>
                        </div>
                        <!-- end row -->
                    </form>
                    <div class="singin-option pt-40">
                        <p class="text-sm text-medium text-center text-gray">
                        Easy Sign In With
                        </p>
                        <div
                        class="
                            button-group
                            pt-40
                            pb-40
                            d-flex
                            justify-content-center
                            flex-wrap
                        "
                        >
                        <button class="main-btn primary-btn-outline m-2">
                            <i class="lni lni-facebook-filled mr-10"></i>
                            Facebook
                        </button>
                        <button class="main-btn danger-btn-outline m-2">
                            <i class="lni lni-google mr-10"></i>
                            Google
                        </button>
                        </div>
                        <p class="text-sm text-medium text-dark text-center">
                        Don’t have any account yet?
                        <a href="/signup.html">Create an account</a>
                        </p>
                    </div>
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
        $("#loginForm").submit(function(e)  {
            e.preventDefault();
            $("#bothres").css("display", "none");
            $("#emailres").css("display", "none");
            $("#passwordres").css("display", "none");

            var email = $("#Email").val();
            var password = $("#Password").val();

            if(email == ""){
                $("#emailres").html("Email address is required");
                $("#emailres").css("display", "block");
                $("#loginBtn").html("Login")
                $("#loginBtn").attr("disabled")
            }

            if(password == ""){
                $("#passwordres").html("Pasword is required");
                $("#passwordres").css("display", "block");
                $("#loginBtn").html("Login")
                $("#loginBtn").attr("disabled")
            }
            
            $.ajax({
                type: 'post',
                url: '<?= $loginUrl; ?>',
                data: "email=" + email + "&password=" + password,
                dataType: "json",
                beforeSend: function() {
                    $("#loginBtn").html("<i class='fa fa-spin fa-spinner'></i> Logging in...")
                    $("#loginBtn").attr("disabled")
                },
                success: function (data) {
                    if(data.status === "error"){
                        $("#" + data.name + "res").html(data.message);
                        $("#" + data.name + "res").css("display", "block");
                        $("#loginBtn").html("Login");
                        $("#loginBtn").attr("enabled")
                    } else {
                        $.ajax({
                            type: 'post',
                            url: '/Account/Login',
                            data: "email=" + email + "&password=" + password,
                            success: function() {
                                window.location.href = "/Shop";
                            }
                        });
                    }
                },
                error: function(){
                    $("#bothres").html("A server error occurred");
                    $("#bothres").css("display", "block");
                    $("#loginBtn").html("Login")
                    $("#loginBtn").attr("disabled")
                }
            });
            
        });
    });
</script>