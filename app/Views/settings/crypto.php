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
    <section class="content">

        <style>
            .coinimage {
                width: 40px;
                height: 40px;
            }
            .form-group{
                margin-bottom: 10px;
            }
        </style>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card-style mb-30" style="padding: 25px 10px;">
                        <div class="title d-flex flex-wrap justify-content-between">
                            <div class="left content" style="text-transform: uppercase;">
                                <h4 class="mb-10" style="color: #33a2a2;">Bitcoin</h4>
                                <h5 class="mb-10"><?= $shops[0]['bitcoin']; ?></h5>
                            </div>
                            <div class="right icon purple">
                                <img src="/assets/images/cryptocurrency/BTC.png" class="img-circle img-bordered-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-style mb-30" style="padding: 25px 10px;">
                        <div class="title d-flex flex-wrap justify-content-between">
                            <div class="left content" style="text-transform: uppercase;">
                                <h4 class="mb-10" style="color: #33a2a2;">Litecoin</h4>
                                <h5 class="mb-10"><?= $shops[0]['litecoin']; ?></h5>
                            </div>
                            <div class="right icon purple">
                                <img src="/assets/images/cryptocurrency/LTC2.png" class="img-circle img-bordered-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-style mb-30" style="padding: 25px 10px;">
                        <div class="title d-flex flex-wrap justify-content-between">
                            <div class="left content" style="text-transform: uppercase;">
                                <h4 class="mb-10" style="color: #33a2a2;">Dogecoin</h4>
                                <h5 class="mb-10"><?= $shops[0]['dogecoin']; ?></h5>
                            </div>
                            <div class="right icon purple">
                                <img src="/assets/images/cryptocurrency/DOGE.png" class="img-circle img-bordered-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <form method="post">
                        <div class="card-style mb-30" style="padding: 25px 10px;">
                            <div class="title d-flex flex-wrap justify-content-between">
                                <div class="left">
                                    <h4 class="text-bold">Address</h4>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <div class="form-group">
                                    <input type="hidden" id="ShopName" name="ShopName" value="JayShopOne">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" value="Save" id="Action" name="Action">
                                </div>
                                <div class="form-group">
                                    <label for="BTCAddress">Bitcoin</label>
                                    <input class="form-control" type="text" id="BTCAddress" name="BTCAddress" placeholder="Insert Address Here" value="">
                                </div>
                                <div class="form-group">
                                    <label for="LTCAddress">Litecoin</label>
                                    <input class="form-control" type="text" id="LTCAddress" name="LTCAddress" placeholder="Insert Address Here" value="">
                                </div>
                                <div class="form-group">
                                    <label for="DOGEAddress">Dogecoin</label>
                                    <input class="form-control" type="text" id="DOGEAddress" name="DOGEAddress" placeholder="Insert Address Here" value="">
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-dark">Save</button>
                            </div>
                        </div>
                    </form>
                    <form method="post">
                        <div class="card-style mb-30" style="padding: 25px 10px;">
                            <div class="title d-flex flex-wrap justify-content-between">
                                <div class="left">
                                    <h4 class="text-bold">Withdraw</h4>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <div class="form-group">
                                    <label>Curency</label>
                                    <select class="form-control" data-val="true" data-val-required="The CryptoCurrency field is required." id="CryptoCurrency" name="CryptoCurrency">
                                        <option value="BTC" selected="selected">Bitcoin</option>
                                        <option value="LTC">Litecoin</option>
                                        <option value="DOGE">Dogecoin</option>
                                    </select>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <label for="sw-lowfee">LowFee</label>
                                            <i class="fa fa-question-circle" rel="tooltip" title="Lets you withdraw with a low fee. Usually takes 24-72 hours, can take up to 7 days."></i>
                                        </div>
                                        <div class="col-auto">
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" id="sw-lowfee" checked="checked" type="checkbox" data-val="true" data-val-required="The LowFee field is required." name="LowFee" value="true">
                                                <label class="custom-control-label" for="sw-lowfee"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" id="ShopName" name="ShopName" value="JayShopOne">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" value="Withdraw" id="Action" name="Action">
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: center;">
                                <button name="EstimateOnly" value="True" type="submit" class="btn btn-dark">Estimate Fee</button>
                                <button name="EstimateOnly" value="False" type="submit" class="btn btn-dark float-right">Withdraw</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <div class="card-style mb-30" style="padding: 25px 10px;">
                        <div class="title d-flex flex-wrap justify-content-between">
                            <div class="left">
                                <h4 class="text-bold">Balances</h4>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <div class="form-group">
                                <table class="table" style="text-align: center;">
                                    <thead>
                                        <tr>
                                            <th>Coin</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Bitcoin
                                            </td>
                                            <td>
                                                <?= $shops[0]['bitcoin']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Litecoin
                                            </td>
                                            <td>
                                                <?= $shops[0]['litecoin']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Dogecoin
                                            </td>
                                            <td>
                                                <?= $shops[0]['dogecoin']; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>