<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

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

    <!-- input style start -->
    <form enctype="multipart/form-data" action="/Shop/<?= $name; ?>/ProductEdit/<?= $uniqueID; ?>" method="post" class="">
        <h5 class="mb-25">General Information</h5>
        <div class="row justify-content-center">
            <div class="col-md-7" style="background-color: #fff; padding: 15px; border-radius: 12px;">
                <input type="hidden" id="uid" name="uid" value="<?= $uniqueID; ?>" />
                <input type="hidden" id="ShopName" name="ShopName" value="<?= $name; ?>" />
                <div class="row">
                    <div class="col-md-5">
                        <div class="input-style-1">
                            <label for="ProductName">Name</label>
                            <input type"text" id="ProductName" maxlength="58" name="ProductName" disabled value="<?= $products['product'][0]['productName'] ?>" required />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-style-1">
                            <label for="ProductName">Stock count</label>
                            <input type"text" id="stock" maxlength="58" name="stock" value="<?= $products['product'][0]['stock'] ?>" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-style-1">
                            <label for="ProductPrice">Price (<?= $shops[0]['CurrencyType']; ?>) </label>
                            <input type="text" id="ProductPrice" maxlength="58" name="ProductPrice" value="<?= $products['product'][0]['productPrice'] ?>" placeholder="0.0" required />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-style-1">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10"><?= $products['product'][0]['description'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-style-1">
                            <label for="ProductType">Product Type</label>
                            <input type="text" id="ProductType" maxlength="58" name="ProductType" value="<?= $products['product'][0]['productType'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h6 class="mb-3">
                            Gateways <i class="fa fa-question-circle" rel="tooltip" title="Please note: you must have these options enabled and set up in the shop settings and enabled here to see it as a payment option."></i>
                        </h6>
                        <div class="row">
                            <div class="col text-center">
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input class="custom-control-input" id="sw-stripe" type="checkbox" <?php if($products['product'][0]['stripeEnabled'] == "true"){echo "checked='checked'";} ?>  name="StripeEnabled" value="true">
                                    <label class="custom-control-label" for="sw-stripe">Stripe</label>
                                </div>
                            </div>

                            <div class="col text-center">
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input class="custom-control-input" id="sw-coinbase-commerce" <?php if($products['product'][0]['coinbaseCommerceEnabled'] == "true"){echo "checked='checked'";} ?> type="checkbox" data-val="true" name="CoinbaseCommerceEnabled" value="true">
                                    <label class="custom-control-label" for="sw-coinbase-commerce">Cryptocurrency</label>
                                </div>
                            </div>

                            <div class="col text-center">
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input class="custom-control-input" id="sw-paypal" <?php if($products['product'][0]['payPalEnabled'] == "true"){echo "checked='checked'";} ?> type="checkbox"  data-val="true" data-val-required="The PayPal field is required." name="PayPalEnabled" value="true">
                                    <label class="custom-control-label" for="sw-paypal">PayPal</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12" style="background-color: #fff; padding: 15px; border-radius: 12px; margin-bottom: 20px">
                        <h5 class="mb-25">Set Product Image</h5> <hr>
                        <div class="text-center bg-gray-light">
                            <input type="hidden" name="oldImage" value="<?= $products['product'][0]['productImage']; ?>">
                            <img style="height:200px;" id="blah" class="img-fluid" src="<?= $products['product'][0]['productImage']; ?>" alt="your image">
                        </div>
                        <div class="input-style-1">
                            <input type="file" accept="image/*" id="productImage" name="productImage"  />
                        </div>
                    </div>
                    <div class="col-md-12" style="background-color: #fff; padding: 15px; border-radius: 12px; margin-bottom: 20px">
                        <h5 class="mb-25">Product Options</h5>
                        <div class="form-group col-md-12">
                            <label class="control-label" for="Position">Position</label>
                            <input class="form-control" type="number" data-val="true" data-val-required="The Position field is required." id="Position" name="Position" value="100000" />
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label" for="WebhookUrl">Webhook URL</label>
                            <input class="form-control" type="text" id="WebhookUrl" value="<?= $products['product'][0]['webhookUrl'] ?>" name="WebhookUrl" placeholder="Discord hooks supported!" value="" />
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label" for="CallbackURL">Callback URL</label>
                            <input class="form-control" type="text" id="CallbackURL" value="<?= $products['product'][0]['callbackURL'] ?>" maxlength="100" name="CallbackURL" value="" />
                        </div> <br><br>
                        <div class="row">
                            <div class="col">
                                <label for="sw-stripe-google-pay">Unlisted</label>
                                <i class="fa fa-question-circle" rel="tooltip" title="This product won't show on your shop page"></i>
                            </div>
                            <div class="col-auto">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="sw-unlisted" data-val="true" data-val-required="The Unlisted field is required." name="Unlisted" value="true">
                                    <label class="custom-control-label" for="sw-unlisted"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="sw-stripe-google-pay">Block VPNs/Proxies</label>
                            </div>
                            <div class="col-auto">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="sw-blockproxy" data-val="true" data-val-required="The Block VPNs/Proxies field is required." name="BlockProxy" value="true">
                                    <label class="custom-control-label" for="sw-blockproxy"></label>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="form-group" align="center">
                            <input type="submit" value="Save Product" class="btn btn-dark" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end card -->
<!-- ======= input style end ======= -->

<?= $this->endSection() ?>
