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

    <script src="/assets/js/jquery.min.js"></script>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="/Shop/<?= $name; ?>/Settings" method="POST" class="card-style">
                    <div class="title d-flex flex-wrap justify-content-between">
                        <div class="left">
                            <h4 class="text-bold">Shop Settings</h4>
                        </div>
                        <div class="right">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <!-- end select -->
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">Manage Shop Settings</h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="NewShopName">Shop Name</label>
                                    <input id="input-username" class="form-control valid" type="text" data-val="true" data-val-length="The field Shop Name must be a string with a minimum length of 4 and a maximum length of 15." data-val-length-max="15" data-val-length-min="4" data-val-regex="The field Shop Name must match the regular expression '^[a-zA-Z0-9.$\-_!]+$'." data-val-regex-pattern="^[a-zA-Z0-9.$\-_!]+$" maxlength="15" name="NewShopName" value="<?= $name; ?>" aria-describedby="input-username-error" aria-invalid="false">
                                    <span class="text-danger field-validation-valid" data-valmsg-for="NewShopName" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="Description">Description</label>
                                    <input id="input-username" class="form-control" type="text" name="Description" value="<?= $shops[0]['Description']; ?>">
                                    <span class="text-danger field-validation-valid" data-valmsg-for="Description" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="SupportEmail">Support Email</label>
                                    <input class="form-control" type="email" data-val="true" data-val-email="The Support Email field is not a valid e-mail address." id="SupportEmail" name="SupportEmail" value="<?= $shops[0]['SupportEmail']; ?>">
                                    <span class="text-danger field-validation-valid" data-valmsg-for="SupportEmail" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="DiscordLink">Discord Link</label>
                                    <input class="form-control" type="url" data-val="true" data-val-url="The Discord Link field is not a valid fully-qualified http, https, or ftp URL." id="DiscordLink" name="DiscordLink" placeholder="https://discord.gg/7BmfKMg" value="<?= $shops[0]['DiscordLink']; ?>">
                                    <span class="text-danger field-validation-valid" data-valmsg-for="DiscordLink" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="CurrencyType">CurrencyType</label>
                                    <select class="form-control valid" data-val="true" data-val-required="The CurrencyType field is required." id="CurrencyType" name="CurrencyType" aria-describedby="CurrencyType-error" aria-invalid="false">
                                        <option value="<?= $shops[0]['CurrencyType']; ?>">(<?= $shops[0]['CurrencyType']; ?>) Select your currency</option>
                                        <option value="USD">(USD) United States dollar</option>
                                        <option value="EUR">(EUR) Euro</option>
                                        <option value="GBP">(GBP) Pound sterling</option>
                                        <option value="AUD">(AUD) Australian dollar</option>
                                        <option value="CAD">(CAD) Canadian dollar</option>
                                        <option value="CHF">(CHF) Swiss franc</option>
                                    </select>
                                    <span class="text-danger field-validation-valid" data-valmsg-for="CurrencyType" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div style="display: inline-flex;">
                                        <label class="control-label" for="CustomDomain">Custom Domain</label>
                                        <span style="font-size: 10px; line-height: 24px;">(Pro) Add cname record pointing to shop.autobuy.io</span>
                                    </div>
                                    <input class="form-control" type="text" id="CustomDomain" name="CustomDomain" value="<?= $shops[0]['CustomDomain']; ?>">
                                    <span class="text-danger field-validation-valid" data-valmsg-for="CustomDomain" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="APIKey">API Key</label>
                                    <div class="input-group mb-3">
                                        <input class="form-control" disabled="" type="text" data-val="true" data-val-required="The API Key field is required." id="APIKey" name="APIKey" value="00000000-0000-0000-0000-0000000">
                                        <div class="input-group-append btn btn-primary">
                                            <div class="input-group-text btn btn-primary">
                                                <input class="form-check-input ml-0" id="keyreset" type="checkbox" data-val="true" data-val-required="The Reset field is required." name="APIKeyReset" value="true">
                                                <label class="form-check-label ml-3" for="keyreset">Reset</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="TawkSiteId">Tawk Direct Chat Link</label>
                                    <a href="https://www.tawk.to/?pid=keoaruz&amp;campaign=AutoBuy%20Dashboard" target="_blank">(Live Chat)</a>
                                    <input class="form-control" type="text" id="TawkSiteId" name="TawkSiteId" placeholder="Admin > Chat Widget > Direct Chat Link" value="<?= $shops[0]['SellerNotes']; ?>">
                                    <span class="text-danger field-validation-valid" data-valmsg-for="TawkSiteId" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="SellerNotes">Seller Notes</label>
                            <textarea rows="4" class="form-control form-control-alternative" data-val="true" data-val-length="The field Seller Notes must be a string with a maximum length of 2000." data-val-length-max="2000" id="SellerNotes" maxlength="2000" name="SellerNotes" placeholder="A few words to your buyers that will appear on every email receipt."><?= $shops[0]['SellerNotes']; ?></textarea>
                            <span class="text-danger field-validation-valid" data-valmsg-for="SellerNotes" data-valmsg-replace="true"></span>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col text-center">
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input class="custom-control-input" id="sw-paypal" type="checkbox" data-val="true" data-val-required="The PayPal field is required." name="PayPalEnabled" value="true">
                                    <label class="custom-control-label" for="sw-paypal">PayPal</label>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input class="custom-control-input" id="sw-stripe" type="checkbox" data-val="true" data-val-required="The Stripe field is required." name="StripeEnabled" value="true">
                                    <label class="custom-control-label" for="sw-stripe">Stripe</label>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input class="custom-control-input" id="sw-coinbase-commerce" type="checkbox" data-val="true" data-val-required="The Crypto Currency field is required." name="CoinbaseCommerceEnabled" value="true">
                                    <label class="custom-control-label" for="sw-coinbase-commerce">Crypto Currency</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>