<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="card-style mb-30">
            <h4 class="mb-10">Top Up Credit</h4>
            <p class="text-sm mb-25">
                Amount of Credit (1 credit = 1 order sent)
            </p>

            <div class="row" id="paycredit">
                <!-- <option value="30">100 credits- $30.00</option>
                                <option value="45">150 credits- $45.00</option>
                                <option value="60">200 credits- $60.00</option> -->
                <div class="col-12">
                    <input type="hidden" name="" value="<?= getenv("soapBaseUrl"); ?>" id="base_url">
                    <div class="select-style-1">
                        <label>Select Credit</label>
                        <div class="select-position">
                            <select v-model="selectedcredit" id="check">
                                <option value="">Select Credit</option>
                                <?php foreach ($credit as $sme) : ?>
                                <option value="<?= $sme["creditPrice"] ?>,<?= $sme["creditQuantity"] ?>">
                                    <?= $sme["creditQuantity"] ?> credits- $<?= $sme["creditPrice"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!-- end select -->
                </div>
                <!-- end col -->
                <div class="col-12">
                    <span v-show="nff" ref="shopname"><?= $name ?></span>
                    <button class="btn btn-info w-100 btn-lg" @click="loadstripe()">Pay With Stripe</button>
                    <br>
                    <br>

                    <button class="btn btn-primary w-100 btn-lg" @click="loadcoinbase()">Pay With Crypto</button>
                    <br>
                    <br>
                    <div ref="paypal"></div>

                </div>

            </div>
            <!-- end row -->

        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<?= $this->endSection() ?>