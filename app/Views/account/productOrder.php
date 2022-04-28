<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <title>AnyBuy <?= $title ?></title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/css/lineicons.css" />
    <link rel="stylesheet" href="/assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="/assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="/assets/css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="/assets/js/jquery.min.js"></script>
</head>
<style>
    .btn.btn-primary.payment-btn>img {
        max-height: 100%;
    }

    .btn-group-vertical-spacing>button,
    .payment-btn {
        width: 100%;
        border-radius: 4px !important;
        margin-bottom: 10px;
        width: 100% !important;
        height: 40px !important;
    }
</style>

<body>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper" style="margin: 0;">
        <!-- ========== header start ========== -->
        <header class="header" style="padding: 10px 0;">
            <div class="container-fluid">
                <div class="row">
                    <input type="hidden" name="" id="base_url" value="<?= getenv("soapBaseUrl"); ?>">
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
                            <!-- <a href="/Account/Register" class="btn btn-primary">Sign Up</a> -->
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
        <div class="content-wrapper">

            <section class="content-header">
                <br />
            </section>
            <section class="content" id="payment">

                <?php if ($orders["orderStatus"] !== "completed") : ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12">
                                <div class="card card-modern">
                                    <div class="card-header">
                                        <span class="card-title"> <img style="height:40px;width:40px;" src="/images/grey cube.png" /> AnyBuy</span>

                                        <div class="float-right">
                                            <p class="m-0">Order ID: <?= $OrderId; ?></p>
                                            <p class="m-0">Email: <?= $orders["orderFrom"] ?></p>
                                            <p class="m-0">Total: $ <?= $orders["totalPrice"] ?> USD</p>
                                        </div>
                                    </div>
                                    <div class="card-body text-center">
                                        <input type="hidden" ref="quantity" value="<?= $orders["quantity"] ?>">
                                        <h3>Waiting for payment</h3>
                                        <div class="fa-3x mt-5 mb-5">
                                            <i class="fas fa-spinner fa-pulse"></i>
                                        </div>

                                        <div ref="paypal"></div>
                                        <p>
                                            Keep this page open or bookmark it. If your order does not complete this page will solve the issue automatically and the product will be displayed below.
                                            <input type="hidden" ref="amount" value="<?= $orders["totalPrice"] ?>">
                                            <input type="hidden" ref="orderid" value="<?= $OrderId ?>">
                                        </p>
                                        <p>
                                            If you paid with crypto please wait the appropriate amount of confirmations for this page to refresh.
                                        </p>
                                        <input type="hidden" ref="uniqueID" value="<?= $orders["productId"] ?>">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12">
                                <div class="card card-modern">
                                    <div class="card-header">
                                        <span class="card-title"> <img style="height:40px;width:40px;" src="/images/grey cube.png" /> AnyBuy</span>

                                        <div class="float-right">
                                            <p class="m-0">Order ID: <?= $OrderId; ?></p>
                                            <p class="m-0">Email: <?= $orders["orderFrom"] ?></p>
                                            <p class="m-0">Total: $ <?= $orders["totalPrice"] ?> USD</p>
                                        </div>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="alert alert-success" role="alert">
                                            Payment Made Successfully
                                        </div>
                                        <p>
                                            Keep this page open or bookmark it. If your order does not complete this page will solve the issue automatically and the product will be displayed below.
                                        </p>
                                        <p>
                                            If you paid with crypto please wait the appropriate amount of confirmations for this page to refresh.
                                        </p>
                                        <hr>
                                        <a href="/@<?= $name ?>" class="btn btn-primary btn-lg btn-block">Home Page</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </section>
        </div>
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
    <script src="/js/vue3.tests.js"></script>
    <script src="/js/axios.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>