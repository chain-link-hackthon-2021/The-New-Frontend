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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css"
        integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="/assets/js/jquery.min.js"></script>
    <link rel="stylesheet" href="/js/style.css">
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
    <style>
    body {
        padding: 0;
        margin: 0;
    }

    #products {
        word-wrap: break-word;
        word-break: break-word;
        font-family: monospace;
        box-sizing: border-box;
        font-size: 12px;
        color: #7c7c7c;
        text-align: left;
        line-height: 25.6px;
        font-weight: normal;
        text-transform: none;
        margin: 0;
        background-color: #f1f5f9;
        border-radius: 4px;
        white-space: pre-wrap;
        display: block;
        padding: 20px;
        height: auto !important;
    }

    .content-header {
        background-color: #eff3f8 !important;
    }

    .content {
        background-color: #eff3f8 !important;
    }

    .col-5 {
        width: 41.66%;
        display: inline-block;
    }

    html {
        -webkit-text-size-adjust: none;
        -ms-text-size-adjust: none;
    }

    .invoice {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, .125);
        position: relative;
    }

    button {
        -webkit-text-size-adjust: none;
        text-decoration: none;
        display: block;
        color: #ffffff;
        background-color: #0068A5;
        border-radius: 4px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        width: 40%;
        width: calc(40% - 2px);
        border-top: 1px solid #0068A5;
        border-right: 1px solid #0068A5;
        border-bottom: 1px solid #0068A5;
        border-left: 1px solid #0068A5;
        padding-top: 5px;
        padding-bottom: 5px;
        font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;
        text-align: center;
        /* mso-border-alt: none; */
        word-break: keep-all;
    }

    .details {
        height: 30px !important;
        line-height: 40px !important;
    }

    #center {
        text-align: center;
    }
    </style>
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
                                <img src="/images/cube.png" alt="AnyBuy Logo" class="brand-image img-circle elevation-3"
                                    width="50px" style="opacity: .8">
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

            <section class="content" id="dropFeedback">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="invoice p-3 " id="invoice">

                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <img style="height:40px;width:40px;" src="/images/grey cube.png" /> AutoBuy
                                        </h4>
                                    </div>
                                    <div id="center" class="col-md-12">
                                        <div style="height: 50px; line-height: 40px; font-size: 10px;"> </div>
                                        <div style="line-height: 44px;">
                                            <font face="Arial, Helvetica, sans-serif" size="5" color="#57697e"
                                                style="font-size: 34px;">
                                                <span
                                                    style="font-family: Arial, Helvetica, sans-serif; font-size: 34px; color: #57697e;">
                                                    Thanks For Your Order!
                                                </span>
                                            </font>
                                            <br />
                                            <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e"
                                                style="font-size: 15px;">
                                                <p
                                                    style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
                                                    Your order details from <b> <?= $orders["shopName"] ?> </b> are
                                                    below.<br />
                                                    <b>Order ID: </b><?= $orders["orderId"] ?>
                                                </p>
                                            </font>
                                        </div>
                                        <div style="height: 5px; line-height: 30px; font-size: 10px;"> </div>
                                    </div>

                                </div>
                                <br>
                                <div class="row">
                                    <input type="hidden" ref="orderId" value="<?= $orders["orderId"] ?>">
                                    <input type="hidden" ref="shopName" value="<?= $orders["shopName"] ?>">
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-borderless"
                                            style="word-wrap:break-word; background-color:#fbfcfd;">
                                            <thead>
                                                <tr>
                                                    <th>Quantity</th>
                                                    <th>Product</th>
                                                    <th>Payment Method</th>
                                                    <th>Delivered To</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?= $orders["quantity"] ?></td>
                                                    <td><?= $orders["productName"] ?></td>
                                                    <td><?= $orders["paymentGateway"] ?></td>
                                                    <td><?= $orders["orderFrom"] ?></td>
                                                    <td>$<?= $orders["totalPrice"] ?> USD</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <h5><u>Message from Seller</u></h5>
                                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                            <br />
                                        </p>
                                    </div>


                                </div>


                                <div class="row no-print">
                                    <div class="col-md-12">
                                    </div>
                                </div>
                            </div>
                            <div class="card card-modern">
                                <div class="card-header text-center">
                                    Delivered Product
                                </div>
                                <tr>
                                    <td align="center" bgcolor="#fbfcfd"
                                        style="border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #eff2f4;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center">
                                                    <!-- <div style="height: 20px; line-height: 60px; font-size: 10px;"> </div>
                                                    <pre id="products">66.7.22,&#xD;&#xA;
                                                        </pre> -->

                                                    <div style="height: 20px; line-height: 60px; font-size: 10px;">
                                                    </div>
                                                    <button data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop">Leave Feedback for
                                                        Seller</button>
                                                    <div style="height: 20px; line-height: 60px; font-size: 10px;">
                                                    </div>
                                                    Need help with your purchase? Please contact the seller.
                                                    <div style="height: 20px; line-height: 60px; font-size: 10px;">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                </tr>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal  fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Send Feedback</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Message:</label>
                                    <textarea class="form-control" id="message-text" v-model="feedmessage"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Rating:</label>
                                    <br>
                                    <div id="rater">
                                    </div>
                                    <span id="ratenum" ref="rate" style="display: none;"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" @click="leavefeed()"
                                    :disabled="btnState">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
                <tr>
                    <td class="iage_footer" align="center" bgcolor="#ffffff">
                        <div style="height:10px; line-height: 80px; font-size: 10px;"> </div>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="center">
                                    <font face="Arial, Helvetica, sans-serif" size="3" color="#96a5b5"
                                        style="font-size: 13px;">
                                        <span
                                            style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #96a5b5;">
                                            © AuyBuy All Rights Reserved.
                                        </span>
                                    </font>
                                </td>
                            </tr>
                        </table>
                        <div style="height: 10px; line-height: 30px; font-size: 10px;"> </div>
                    </td>
                </tr>

        </div>
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
    <script src="/js/rater-js.js"></script>
    <script src="/js/vue3.tests.js"></script>
    <script src="/js/axios.min.js"></script>
    <script src="/js/app.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    var starRating5 = raterJs({
        starSize: 32,
        // rating: 4.4,
        element: document.querySelector("#rater"),
        rateCallback: function rateCallback(rating, done) {
            this.setRating(rating);
            done();

        },
        onHover: function(currentIndex, currentRating) {
            document.querySelector('#ratenum').textContent = currentIndex;
        },
        onLeave: function(currentIndex, currentRating) {
            document.querySelector('#ratenum').textContent = currentRating;
        }
    });
    </script>
</body>

</html>