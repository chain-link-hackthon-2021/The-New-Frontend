<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <title>AnyBuy</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/css/lineicons.css" />
    <link rel="stylesheet" href="/assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="/assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="/assets/css/main.css" />
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
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    <div class="card-style mb-30">
                        <h4>
                            <?= $products[0]['productName']; ?>
                        </h4>
                        <hr />
                        <div>
                            <?= nl2br($products[0]['description']); ?>
                        </div>
                    </div>
                </div>
                <!-- End Col -->
                <div class="col-lg-3 col-md-4">
                    <div class="card-style mb-30">
                        <h4>
                            <?= $products[0]['productPrice']; ?> <strong><?= $shops[0]['CurrencyType']; ?></strong>
                        </h4>
                        <hr />
                        <h6 class="mb-25">
                            Quantity
                        </h6>
                        <div class="input-style-1" style="display: inline-flex;">
                            <button type="button" id="reduceQuantityButton" class="btn btn-primary" style="width: 50px;"> <strong> - </strong> </button>
                            <input type="number" name="Quantity" value="1" style="text-align: center;" id="Quantity" onkeyup="qproduct()">
                            <button type="button" id="increaseQuantityButton" class="btn btn-primary" style="width: 50px;"> <strong> + </strong> </button>
                        </div>
                        <div class="result">
                            <div class="text-center">
                                <input type="hidden" name="productPrice" id="productPrice">
                                <span id="visiblePrice"> <?= $products[0]['productPrice']; ?></span> <?= $shops[0]['CurrencyType']; ?>
                            </div>
                        </div>
                        <hr />
                        <div class="text-center">
                            <button id="buyNow" class="btn btn-primary payment-btn">Buy Now</button>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-4 col-sm-push-8">Seller: </div>
                            <div class="col-sm-8 col-sm-pull-4"> <a href="/@<?= $name; ?>"><?= $name; ?></a></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-sm-push-8">Stock: </div>
                            <div class="col-sm-8 col-sm-pull-4"> <?= $products[0]['stock']; ?></div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 col-sm-push-8">Feedback: </div>
                            <div class="col-sm-8 col-sm-pull-4"> <?= $products[0]['Feedback']; ?></div>
                        </div>
                    </div>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <style>
            input[type=number] {
                -moz-appearance: textfield;
            }

            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        </style>
        <script>
            function qproduct() {
                let unitPrice = parseInt("<?= $products[0]['productPrice']; ?>");
                let quantity = parseInt($("#Quantity").val());
                let unitp = parseInt("<?= $products[0]['stock']; ?>");
                if (unitp >= quantity) {
                    let newQuantity = parseInt(quantity);
                    $("#Quantity").val(newQuantity)
                    let newPrice = parseInt(unitPrice * newQuantity);
                    $("#productPrice").val(newPrice)
                    $("#visiblePrice").html(newPrice)
                } else {
                    let newQuantity = parseInt(quantity);
                    $("#Quantity").val(unitp)
                    let newPrice = parseInt(unitPrice * unitp);
                    $("#productPrice").val(newPrice)
                    $("#visiblePrice").html(newPrice)
                }

            }
            $(document).ready(function() {

                $("#reduceQuantityButton").on("click", function() {
                    let quantity = parseInt($("#Quantity").val());
                    let unitPrice = parseInt("<?= $products[0]['productPrice']; ?>");

                    if (quantity > 1) {
                        let newQuantity = parseInt(quantity - 1);
                        $("#Quantity").val(newQuantity);
                        let newPrice = parseInt(unitPrice * newQuantity);
                        $("#productPrice").val(newPrice)
                        $("#visiblePrice").html(newPrice)
                    }
                })
                $("#increaseQuantityButton").on("click", function() {

                    let unitPrice = parseInt("<?= $products[0]['productPrice']; ?>");
                    let quantity = parseInt($("#Quantity").val());
                    let unitp = parseInt("<?= $products[0]['stock']; ?>");

                    if (unitp !== quantity) {

                        let newQuantity = parseInt(quantity + 1);
                        $("#Quantity").val(newQuantity)
                        let newPrice = parseInt(unitPrice * newQuantity);
                        $("#productPrice").val(newPrice)
                        $("#visiblePrice").html(newPrice)
                    } else {
                        let newQuantity = parseInt(quantity);
                        $("#Quantity").val(newQuantity)
                        let newPrice = parseInt(unitPrice * newQuantity);
                        $("#productPrice").val(newPrice)
                        $("#visiblePrice").html(newPrice)
                    }


                })
                $("#buyNow").on("click", function() {
                    let quantity = parseInt($("#Quantity").val());
                    window.location.href = "/@<?= $name; ?>/checkout/<?= $uniqueID; ?>/" + quantity
                })
            });
        </script>
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