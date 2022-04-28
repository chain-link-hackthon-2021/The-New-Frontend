<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

    <script src="/assets/js/jquery.min.js"></script>
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
                        <button type="button" id="reduceQuantityButton" class="btn btn-primary" style="width: 60px;"> <strong> - </strong> </button>
                        <input type="number" name="Quantity" value="1" style="text-align: center;" id="Quantity" >
                        <button type="button" id="increaseQuantityButton" class="btn btn-primary" style="width: 60px;"> <strong> + </strong> </button>
                    </div>
                    <div class="result">
                        <div class="text-center">
                            <input type="hidden" name="productPrice" id="productPrice">
                            <span id="visiblePrice"> <?= $products[0]['productPrice']; ?></span> <?= $shops[0]['CurrencyType']; ?>
                        </div>
                    </div>
                    <hr />
                    <div class="text-center">
                        <button id="buyNow" class="btn btn-primary">Buy Now</button>
                    </div>
                    <br>
                    <p>
                        Seller: <a href="/@<?= $name; ?>"><?= $name; ?></a>
                    </p>
                    <p>
                        Stock: <?= $products[0]['stock'];; ?>
                    </p>
                    <p>
                        Feedback: <?= $products[0]['Feedback']; ?>
                    </p>
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
    <style>
        input[type=number]{
            -moz-appearance: textfield;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button{
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
    <script>
        $(document).ready(function() {
            $("#reduceQuantityButton").on("click", function(){
                let quantity = parseInt($("#Quantity").val());
                let unitPrice = parseInt("<?= $products[0]['productPrice']; ?>");
                
                if(quantity > 1){
                    let newQuantity = parseInt(quantity-1);
                    $("#Quantity").val(newQuantity);
                    let newPrice = parseInt(unitPrice*newQuantity);
                    $("#productPrice").val(newPrice)
                    $("#visiblePrice").html(newPrice)
                }
            })
            $("#increaseQuantityButton").on("click", function(){
                let unitPrice = parseInt("<?= $products[0]['productPrice']; ?>");
                let quantity = parseInt($("#Quantity").val());
                let newQuantity = parseInt(quantity+1);
                $("#Quantity").val(newQuantity)
                let newPrice = parseInt(unitPrice*newQuantity);
                $("#productPrice").val(newPrice)
                $("#visiblePrice").html(newPrice)
            })
            $("#buyNow").on("click", function(){
                let quantity = parseInt($("#Quantity").val());
                window.location.href= "/@<?= $name; ?>/Product/<?= $uniqueID; ?>/" + quantity
            })
        });
    </script>

<?= $this->endSection() ?>