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
input[type=number] {
    -moz-appearance: textfield;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>

<style>
.apply {
    font-size: 10px;
    font-weight: bold;
    text-align: center;
}

.apply:hover {
    cursor: pointer;
}

#couponMessage,
#couponNameMessage {
    font-size: 10px;
}
</style>
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
                <input type="hidden" name="" id="base_url" value="<?= getenv("soapBaseUrl"); ?>">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-6">
                        <div class="header-left d-flex align-items-center">
                            <a href="/" id="header-logo" class="navbar-brand ml-1 p-0">
                                <img src="/images/cube.png" alt="AnyBuy Logo" class="brand-image img-circle elevation-3"
                                    width="50px" style="opacity: .8">
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
        <?php
        $productID = $products[0]['uniqueID'];
        ?>
        <!-- ========== header end ========== -->
        <br />
        <!-- ========== signin-section start ========== -->
        <div class="container-fluid row" style="padding: 10px 15px;" id="loadpayment">

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
            <div class="col-lg-8 col-md-7">
                <div id="productBar" class="card-style mb-30">
                    <h4>
                        <?= $products[0]['productName']; ?>
                    </h4>
                    <hr />
                    <input type="text" class="form-control" ref="shopName" value="<?= $name; ?>" name="shopName"
                        id="shopName" placeholder="" hidden>
                    <input type="text" class="form-control" ref="productName"
                        value="<?= $products[0]['productName']; ?>" name="productName" id="productName" placeholder=""
                        hidden>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="email" type="email" class="form-control" ref="orderFrom" name="email"
                            placeholder="Enter Email Address">
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-lg-4 col-md-5">
                <div id="qtyBar" class="card-style mb-30 text-center">
                    <h4>
                        $ <?= $products[0]['productPrice']; ?> <?= $shops[0]['CurrencyType']; ?>
                    </h4>
                    <hr />
                    <h6 class="mb-25">
                        Quantity
                    </h6>
                    <div class="input-style-1" style="display: inline-flex;">
                        <button type="button" id="reduceQuantityButton" class="btn btn-primary" style="width: 60px;">
                            <strong> - </strong> </button>
                        <input type="number" name="Quantity" ref="quantity" value="<?= $quantity; ?>"
                            style="text-align: center;" id="Quantity" onkeyup="qproduct()">
                        <button type="button" id="increaseQuantityButton" class="btn btn-primary" style="width: 60px;">
                            <strong> + </strong> </button>
                    </div>
                    <div class="result text-center">
                        <input type="text" class="form-control" ref="productId" value="<?= $products[0]['uniqueID']; ?>"
                            name="productId" id="productId" placeholder="" hidden>
                        <div>
                            <input type="hidden" name="unitPrice" ref="unitPrice" id="unitPrice"
                                value="<?= $products[0]['productPrice']; ?>">
                            <input type="hidden" name="productPrice" id="productPrice" ref="price"
                                value="<?= $products[0]['productPrice'] *  $quantity; ?>">
                            <span id="Camount" ref="Camount"> 0 </span>% Discount
                            <br>
                            <span id="visiblePrice"> <?= $products[0]['productPrice'] *  $quantity; ?> </span>
                            <?= $shops[0]['CurrencyType']; ?>
                        </div>
                        <div class="apply" onclick="showModal()">
                            Apply a coupon
                        </div>
                        <div class="text-danger" id="couponMessage"></div><br>
                        <div class="text-success" id="couponNameMessage"></div>
                        <input type="hidden" name="couponCodeH" id="couponCodeH">
                        <input type="hidden" name="couponID" id="couponID">
                        <input type="hidden" name="couponUses" id="couponUses">


                    </div>
                    <br>


                    <p>
                        Seller: <a href="/@<?= $name; ?>"><?= $name; ?></a>
                    </p>
                    <p>
                        Stock: <?= $products[0]['stock']; ?>
                    </p>
                    <p>
                        Feedback: <?= $products[0]['Feedback']; ?>
                    </p>
                    <hr>

                    <div id="hid">
                        <button type="button" id="placeOrder" class="btn btn-success payment-btn">Place Order</button>
                        <hr>
                    </div>

                    <div id="hidden" style="display:none; ">
                        <?php if (!empty($shops[0]['coinbaseKey'])) : ?>
                        <button class="btn btn-primary  payment-btn" @click="paycheckout('coinbase')"
                            v-html="btntwoValue" :disabled="btnState">

                        </button>
                        <?php endif; ?>
                        <?php if (!empty($shops[0]['MerchantId'])) : ?>
                        <button class="btn btn-warning  payment-btn" @click="paycheckout('paypal')" v-html="btnoneValue"
                            :disabled="btnState">

                        </button>
                        <?php endif; ?>
                        <?php if (!empty($shops[0]['stripeID'])) : ?>
                        <button class="btn btn-info  payment-btn" @click="paycheckout('stripe')" v-html="btnthreeValue"
                            :disabled="btnState">

                        </button>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <!-- End Col -->
            <!-- End Row -->

            <!-- Modal -->
            <div class="modal" style="display: none; background: rgba(0, 0, 0, 0.5);" id="exampleModal" tabindex="-1"
                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Apply a Coupon</h5>
                            <button type="button" onclick="closeModal()" class="btn close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" placeholder="Coupon code" name="couponCode" id="couponCode"
                                class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="closeModal()"
                                data-dismiss="modal">Close</button>
                            <button type="button" id="apply" class="btn btn-primary">Apply</button>
                        </div>
                    </div>
                </div>
            </div>
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
    newpriceme = 0;
    $("#placeOrder").on("click", function() {
        let quantity = parseInt($("#Quantity").val());
        let newPrice = $("#productPrice").val();
        let email = $("#email").val();
        if (email == "" || newPrice == "" || quantity == "") {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: ' Empty Field Data'
            })
        } else {
            $("#placeOrder").prop("disabled", true);
            axios.post("<?= $url ?>api/v1/fetch/single/blacklist", JSON.stringify({
                shopName: "<?= $name; ?>",
                "BlockedData": "" + email
            }), {
                headers: {
                    "Access-Control-Allow-Origin": "*",
                    "Access-Control-Allow-Headers": "*",
                    "Content-Type": "multipart/form-data",
                    "Access-Control-Allow-Headers": "Origin, Content-Type, X-Auth-Token",
                    "content-type": "application/json",
                    "Access-Control-Allow-Methods": " POST",
                },
            }).then(res => {
                console.log(res.data);
                if (res.data.blacklists.length > 0) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'warning',
                        title: ' Your Email Address Has Been Blocked.'
                    });
                } else {
                    $("#placeOrder").prop("disabled", false);
                    var newpriceme = newPrice;
                    $("#hidden").show();
                    $("#hid").hide();

                }
            }).catch(error => {
                $("#placeOrder").prop("disabled", false);
                console.log(error);
            });


        }
    });

    function outOfStock() {
        let stock = <?= $products[0]['stock']; ?>;
        if (stock == 0) {
            $("#qtyBar").html("<strong class='text-danger'>Out of stock</strong>");
            $("#productBar").html("<strong><?= $products[0]['productName']; ?></strong>");
            $('#email').prop('disabled', true);
            $('#placeOrder').prop('disabled', true);
        }
    }

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

    function closeModal() {
        $("#exampleModal").css("display", "none");
        $("#couponCode").val("");
        $("#couponNameMessage").html("");
        $("#couponMessage").html("");
    }

    function showModal() {
        $("#exampleModal").css("display", "block");
    }

    function applyCoupon(code, newPrice) {
        $.ajax({
            url: '/Shop/<?= $name; ?>/ApplyCoupon',
            data: 'couponCode=' + code + "&price=" + newPrice + "&productID=<?= $productID; ?>",
            type: 'POST',
            beforeSend: function() {
                $("#couponMessage").html("");
                $("#couponNameMessage").html("");
                $("#couponID").val("");
                $("#couponUses").val("");
            },
            success: function(data) {
                let result = JSON.parse(data);
                let quantity = parseInt($("#Quantity").val());
                let unitPrice = parseInt("<?= $products[0]['productPrice']; ?>");
                $("#couponCode").val("");
                if (result.status == "success") {
                    $("#hidden").hide();
                    $("#hid").show();
                    $(".apply").css("display", "none");
                    newPrice = result.newPrice;
                    $("#productPrice").val(newPrice);
                    $("#visiblePrice").html(newPrice);
                    $("#couponMessage").html("");
                    $("#couponNameMessage").html(code);
                    $("#couponCodeH").val(code)
                    $("#Camount").html(result.discount);
                    console.log(result);
                    $("#couponID").val(result.couponID)
                    let cc = parseInt(result.couponUses)
                    let newC = parseInt(cc + 1)
                    $("#couponUses").val(newC)
                    // paymentApi.close();
                } else {
                    $("#couponMessage").html(result.message);
                    $("#couponNameMessage").html("");
                    let newPrice = parseInt(unitPrice * quantity);
                    $("#productPrice").val(newPrice)
                    $("#visiblePrice").html(newPrice)
                    $("#couponID").val("")
                    $("#couponUses").val("")
                }
            }
        });
    }



    $(document).ready(function() {
        outOfStock();
        $("#apply").on("click", function() {
            outOfStock();
            var couponCode = $("#couponCode").val();
            $("#exampleModal").css("display", "none");
            var newPrice = parseInt($("#productPrice").val());
            applyCoupon(couponCode, newPrice);
        });

        $("#Quantity").on("keyup", function() {
            let quantity = parseInt($("#Quantity").val());
            let unitPrice = parseInt("<?= $products[0]['productPrice']; ?>");
            outOfStock();

            if (quantity > 1) {
                let newPrice = parseInt(unitPrice * quantity);
                $("#productPrice").val(newPrice)
                $("#visiblePrice").html(newPrice)

                outOfStock();

                var couponCode = $("#couponCode").val();
                if (couponCode != "") {
                    applyCoupon(couponCode, newPrice);
                }
            } else {
                let newPrice = parseInt(unitPrice * 1);
                $("#productPrice").val(newPrice)
                $("#visiblePrice").html(newPrice)
                $("#Quantity").val("1")

                outOfStock();

                var couponCode = $("#couponCode").val();
                if (couponCode != "") {
                    applyCoupon(couponCode, newPrice);
                }
            }
        })

        $("#reduceQuantityButton").on("click", function() {
            let quantity = parseInt($("#Quantity").val());
            let unitPrice = parseInt("<?= $products[0]['productPrice']; ?>");

            outOfStock();
            if (quantity > 1) {
                outOfStock();
                let newQuantity = parseInt(quantity - 1);
                $("#Quantity").val(newQuantity);
                let newPrice = parseInt(unitPrice * newQuantity);
                $("#productPrice").val(newPrice)
                $("#visiblePrice").html(newPrice)

                var couponCode = $("#couponCode").val();
                if (couponCode != "") {
                    applyCoupon(couponCode, newPrice);
                }
            }
        });

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

            outOfStock();

            var couponCode = $("#couponCode").val();
            if (couponCode != "") {
                applyCoupon(couponCode, newPrice);
            }
        });
    });
    let newPrice = $("#visiblePrice").val();

    let email = $("#email").val();
    //console.log(newPrice);
    </script>
</body>

</html>