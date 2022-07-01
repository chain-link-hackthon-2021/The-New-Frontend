<div class="row">
    <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
            <div class="icon purple">
                <i class="lni lni-cart-full"></i>
            </div>
            <div class="content">
                <h6 class="mb-10">New Orders</h6>
                <h3 class="text-bold mb-10"><?= $DailyOrderCount; ?></h3>
            </div>
        </div>
        <!-- End Icon Cart -->
    </div>
    <!-- End Col -->
    <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
            <div class="icon success">
                <i class="lni lni-dollar"></i>
            </div>
            <div class="content">
                <h6 class="mb-10">Daily Revenue</h6>
                <h3 class="text-bold mb-10">$<?= number_format($DailyRevenue); ?></h3>
            </div>
        </div>
        <!-- End Icon Cart -->
    </div>
    <!-- End Col -->
    <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
            <div class="icon primary">
                <i class="lni lni-credit-cards"></i>
            </div>
            <div class="content">
                <h6 class="mb-10">Total Income</h6>
                <h3 class="text-bold mb-10">$<?= number_format($overallSales); ?></h3>
            </div>
        </div>
        <!-- End Icon Cart -->
    </div>
    <!-- End Col -->
    <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
            <div class="icon orange">
                <i class="lni lni-user"></i>
            </div>
            <div class="content">
                <h6 class="mb-10">New User</h6>
                <h3 class="text-bold mb-10">34567</h3>
            </div>
        </div>
        <!-- End Icon Cart -->
    </div>
    <!-- End Col -->
</div>
<!-- End Row -->