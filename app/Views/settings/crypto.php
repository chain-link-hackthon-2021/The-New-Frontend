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

    .form-group {
        margin-bottom: 10px;
    }
    </style>
    <div class="container" id="withdrawcrypto">
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
            <div class="col-md-7">

                <div class="card-style mb-30" style="padding: 25px 10px;">
                    <div class="title d-flex flex-wrap justify-content-between">
                        <div class="left">
                            <h4 class="text-bold">Withdraw</h4>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <div class="form-group">
                            <label>Wallet Address</label>
                            <input type="text" name="" class="form-control" ref="walletadd"
                                value="<?= $shops[0]['SellerBtc']; ?>">
                        </div>
                        <input type="hidden" name="" class="form-control" ref="shopName"
                            value="<?= $shops[0]['name']; ?>">
                        <div class="form-group">
                            <label>Curency</label>
                            <input type="number" name="" class="form-control" v-model="amount">
                            <hr>
                        </div>
                        <div class="form-group">

                            <button type="submit" class="btn btn-dark" :disabled="btnState"
                                @click="withdrawcrypto()">Withdraw</button>
                        </div>
                    </div>

                </div>

            </div>

            <!-- <div class="col-md-4">
                    <div class="card-style mb-30" style="padding: 25px 10px;">
                        <div class="title d-flex flex-wrap justify-content-between">
                            <div class="left content" style="text-transform: uppercase;">
                                <h4 class="mb-10" style="color: #33a2a2;">Litecoin</h4>
                                <h5 class="mb-10"></h5>
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
                                <h5 class="mb-10"></h5>
                            </div>
                            <div class="right icon purple">
                                <img src="/assets/images/cryptocurrency/DOGE.png" class="img-circle img-bordered-sm">
                            </div>
                        </div>
                    </div>
                </div> -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-style mb-30" style="padding: 25px 10px;">
                    <div class="title d-flex flex-wrap justify-content-between">
                        <div class="left">
                            <h4 class="text-bold">Withdraw History</h4>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <div class="form-group">
                            <table class="table" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Amount</th>
                                        <th>address</th>
                                        <th>Request Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($withdraw as $value) : ?>
                                    <tr>
                                        <td>
                                            <?= $value['withdrawId']; ?>
                                        </td>
                                        <td>
                                            <?= $value['amount']; ?>
                                        </td>
                                        <td>
                                            <?= $value['btc_address']; ?>
                                        </td>
                                        <td>
                                            <?= $value['created_at']; ?>
                                        </td>
                                        <td>
                                            <?= $value['status']; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
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