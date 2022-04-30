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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>
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
                                <input type="hidden" name="" id="site_url" value="<?= base_url(); ?>">
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

            <section class="content">

                <div class="container" id="btcpayment">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12">
                            <div class="card card-modern">
                                <div class="card-header">
                                    <span class="card-title"> <img style="height:40px;width:40px;" src="/images/cube.png" /> AutoBuy</span>
                                    <div class="float-right">
                                        <div id="clock">
                                            <span class="hours"></span>:
                                            <span class="minutes"></span>:
                                            <span class="seconds"></span>:
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <span ref="shopName" v-show="s"><?= $orders['shopName']; ?></span>
                                    <span ref="orderId" v-show="s"><?= $orders['orderId']; ?></span>
                                    <div id="qrcode">
                                        <img src="https://www.bitcoinqrcodemaker.com/api/?style=bitcoin&amp;address=<?= $orders['btc_address']; ?>" height="150" width="150" alt="Bitcoin QR Code" />
                                    </div>
                                    <div class="form-group text-center mt-2">
                                        <label class="control-label" for="CryptoAmount">Amount</label>
                                        <input value="<?= $orders['btcAmount']; ?>" class="form-control" disabled>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="control-label">Bitcoin Address</label>
                                        <input class="form-control" disabled type="text" id="CryptoAddress" name="CryptoAddress" value="<?= $orders['btc_address']; ?>">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="control-label">Amount Paid</label>
                                        <input class="form-control" disabled type="text" v-model="paidamount">
                                    </div>
                                    <p class="mt-2">Send <b><?= $orders['btcAmount']; ?></b> BTC to <b ref="newAddress"><?= $orders['btc_address']; ?></b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .form-group {
                        max-width: 500px;
                        margin: 0 auto;
                    }

                    input {
                        text-align: center;
                    }
                </style>

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

    <script>
        setTimeout(function() {
            // window.location = "/@<?= $name ?>/CryptoPayment/<?= $OrderId; ?>";
        }, 30000);
        const d = new Date("<?= $orders['created_at']; ?>");
        mdate = d.toLocaleString()
        $('#clock').countdown(mdate.split(',')[0] + mdate.split(',')[1] + " UTC", function(event) {
            var totalHours = 12;
            var totalMinutes = event.strftime('%M');
            var totalSeconds = event.strftime('%S');
            var time = totalHours + ":" + totalMinutes + ":" + totalSeconds;
            $('#clock').html(time);
        });
    </script>
</body>

</html>