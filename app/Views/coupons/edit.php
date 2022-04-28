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
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap justify-content-between">
                        <div class="left">
                            <h4 class="text-medium mb-10">Edit coupon</h4>
                        </div>
                    </div>
                    <!-- End Title -->
                    <div class="chart">
                        <div class="card-style mb-30">
                            <form action="/Shop/<?= $name; ?>/CouponEdit/<?= $coupon[0]['couponID']; ?>" method="post" id="editcouponForm">
                                <div class="row">
                                    <div class="col-md-12 mb-30">
                                        <label for="couponCode">Code</label>
                                        <input type="text" class="form-control" name="couponCode" id="couponCode" value="<?= $coupon[0]['couponCode']; ?>" >
                                    </div>
                                    <div class="col-md-12 mb-30">
                                          <label for="couponProducts">Products</label>
                                          <select multiple class="form-control" name="couponProducts[]" id="Products">
                                                <option></option>
                                                <?php
                                                    if(!empty($products)){
                                                        foreach ($products as $product) {
                                                            ?>
                                                                <option value="<?= $product['uniqueID']; ?>" class="form-control" style="margin-bottom: 7px;"><?= $product['productName']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-30">
                                        <label for="couponDiscount">Discount <b>(%)</b></label>
                                        <input type="text" class="form-control" name="couponDiscount" id="couponDiscount" value="<?= $coupon[0]['couponDiscount']; ?>" >
                                    </div>
                                    <div class="col-md-12 mb-30">
                                        <label for="couponMaxUse">MaxUses</label>
                                        <input type="text" class="form-control" name="couponMaxUse" id="couponMaxUse" value="<?= $coupon[0]['couponMaxUse']; ?>" >
                                    </div>
                                    <div class="col-md-12" style="text-align: right;">
                                        <button class="btn btn-primary" id="editButton" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Chart -->
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>

<?= $this->endSection() ?>