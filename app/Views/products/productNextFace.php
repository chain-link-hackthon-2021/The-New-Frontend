<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<?php
$productID = $products[0]['uniqueID'];
?>

<script src="/assets/js/jquery.min.js"></script>
<div class="container-fluid" style="padding: 10px 15px;">
    <form class="row" action="/@<?= $name; ?>/Product/<?= $products[0]['uniqueID']; ?>" method="POST">
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
                <input type="text" class="form-control" value="<?= $products[0]['productName']; ?>" name="productName"
                    id="productName" placeholder="" hidden>
                <input type="email" name="email" placeholder="Email" id="email" required class="form-control">
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
                    <input type="number" name="Quantity" value="<?= $quantity; ?>" style="text-align: center;"
                        id="Quantity">
                    <button type="button" id="increaseQuantityButton" class="btn btn-primary" style="width: 60px;">
                        <strong> + </strong> </button>
                </div>
                <div class="result text-center">
                    <div>
                        <input type="hidden" name="unitPrice" id="unitPrice"
                            value="<?= $products[0]['productPrice']; ?>">
                        <input type="hidden" name="productPrice" id="productPrice"
                            value="<?= $products[0]['productPrice'] *  $quantity; ?>">
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
                <button type="submit" id="placeOrder" class="btn btn-success">Place Order</button>
            </div>
        </div>
        <!-- End Col -->
    </form>
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
                    <input type="text" placeholder="Coupon code" name="couponCode" id="couponCode" class="form-control">
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
                newPrice = result.newPrice;
                $("#productPrice").val(newPrice);
                $("#visiblePrice").html(newPrice);
                $("#couponMessage").html("");
                $("#couponNameMessage").html(code);
                $("#couponCodeH").val(code)
                $("#couponID").val(result.couponID)
                let cc = parseInt(result.couponUses)
                let newC = parseInt(cc + 1)
                $("#couponUses").val(newC)
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

function outOfStock() {
    let stock = <?= $products[0]['stock']; ?>;
    if (stock == 0) {
        $("#qtyBar").html("<strong class='text-danger'>Out of stock</strong>");
        $("#productBar").html("<strong><?= $products[0]['productName']; ?></strong>");
        $('#email').prop('disabled', true);
        $('#placeOrder').prop('disabled', true);
    }
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
        let newQuantity = parseInt(quantity + 1);
        $("#Quantity").val(newQuantity)
        let newPrice = parseInt(unitPrice * newQuantity);
        $("#productPrice").val(newPrice)
        $("#visiblePrice").html(newPrice)

        outOfStock();

        var couponCode = $("#couponCode").val();
        if (couponCode != "") {
            applyCoupon(couponCode, newPrice);
        }
    });
});
</script>

<?= $this->endSection() ?>