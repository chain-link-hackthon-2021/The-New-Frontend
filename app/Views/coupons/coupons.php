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
                            <h6 class="text-medium mb-10">Coupons</h6>
                        </div>
                        <div class="right">
                            <form action="/Shop/<?= $name; ?>/Coupon" method="post" style="display: inline-flex;">
                                <input type="text" class="form-control" name="couponCode" id="couponCode">
                                <button class="btn btn-success" style="margin-left: 7px;" type="submit">Create</button>
                            </form>
                        </div>
                    </div>
                    <hr />
                    <!-- End Title -->
                    <div class="chart">
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6>Name</h6>
                                        </th>
                                        <th>
                                            <h6>Discount</h6>
                                        </th>
                                        <th>
                                            <h6>Uses</h6>
                                        </th>
                                        <th>
                                            <h6>Manage</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                </thead>
                                <tbody>
                                    <?php if(empty($coupons)){
                                        ?>
                                            <tr class="odd">
                                                <td colspan="5" class="min-width" valign="top">No data available in table</td>
                                            </tr>
                                        <?php
                                        } else {
                                            foreach($coupons as $coupon){
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?= $coupon['couponCode']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $coupon['couponDiscount']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $coupon['couponUses']; ?>
                                                        </td>
                                                        <td>
                                                            <span title="Edit">
                                                                <a  class="text-primary" href="/Shop/<?= $name; ?>/CouponEdit/<?= $coupon['couponID']; ?>">
                                                                    <i class="lni lni-pencil"></i>
                                                                </a>
                                                            </span>
                                                            <span title="Delete">
                                                                <a class="text-danger" onclick="deleteFunction('<?= $coupon['couponID']; ?>')">
                                                                    <i class="lni lni-trash-can"></i>
                                                                </a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <!-- end table -->
                        </div>
                    </div>
                    <!-- End Chart -->
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
    <script>
        function deleteFunction(couponID){
            let text = "Are you sure you want to delete this coupon?"
            if(confirm(text) == true){
                $.ajax({
                    url: "<?= $deleteUrl; ?>",
                    type: "POST",
                    data: "couponID=" + couponID,
                    success: function() {
                        window.location.href = "/Shop/<?= $name; ?>/Coupons";
                    }
                });
            }
        }
    </script>

<?= $this->endSection() ?>